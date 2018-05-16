<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\models\Chutro;
use Maatwebsite\Excel\Facades\Excel;

class HostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('host');
    }

    public function getBuilding(Request $request)
    {
        $page = (int)$request['per_page'];
        set_time_limit(40*$page);
        $all = [];
            for ($i = 1; $i <= $page; $i++) {
                $url = $request['building_link'];
                if ($i != 1) {
                    $url = $request['building_link'] . '/page/' . $i;
                }
                $info = $this->getInfo($url);
                array_push($all, $info);
            }

//        dd($all);
        Excel::create('Chủ trọ', function ($excel) use ($all) {
            $excel->sheet('Chủ trọ', function ($sheet) use ($all) {
                $defaultArr = array("Tiêu đề", "Người đăng", "Email", "Địa chỉ", "Số điện thoại");
                $sheet->row(1, $defaultArr);
                $sheet->row(1, function ($row) {
                    $row->setBackground('#ffff00');
                });
                $c_end = chr(ord('A') + count($defaultArr));
                for ($i = 'A'; $i <= $c_end; $i++) {
                    $sheet->cell($i . '1', function ($cell) {
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                }
                $emails = [];
                $n = 2;
                foreach ($all as $items) {
                    foreach ($items as $index => $host) {
                        if (isset($host)) {
                            $defaultValueArr = [
                                $host->title[0],
                                $host->user[0],
                                $host->email[0],
                                $host->address[0],
                                $host->phone[0]
                            ];
                            if(!in_array($host->email[0],$emails)) {
                                array_push($emails, $host->email[0]);
                                $sheet->row($index + $n, $defaultValueArr);
                                $sheet->getStyle('A2:' . chr(ord('A') + count($defaultValueArr)) . $sheet->getHighestRow())
                                    ->getAlignment()->setWrapText(true);
                            } else $n--;
                        }
                    }
                    $n += count($items);
                }

            });

        })->export('xls');
    }

    public function getInfo($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $data = "";
        $temps = $crawler->filter('.arttitle > h3 > a')->each(function ($node) {
//            sleep(1);
            return $node->attr('href');
        });
        $info = [];

        foreach ($temps as $temp) {
            $crawlers = $client->request('GET', $temp);
            $title = $crawlers->filter('.dtitle > a')->each(function ($node) {
                return $node->attr('title');
            });
            $user = $crawlers->filter('.dtnguoidang > span')->each(function ($node) {
                return $node->text();
            });
            $email = $crawlers->filter('.dtemail > a')->each(function ($node) {
                return $node->text();
            });
            $address = $crawlers->filter('.direction > span')->each(function ($node) {
                return $node->text();
            });
            $phone = $crawlers->filter('.dphone > span > a')->each(function ($node) {
                return $node->text();
            });
            if(!in_array($email,array_column($info,'email'))) {
                $chutro = new Chutro($title, $user, $email, $address, $phone);
                array_push($info, $chutro);
            }
        }
//        dd(array_column($info,'email'));
        return $info;
    }
}
