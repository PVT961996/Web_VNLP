<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Goutte\Client;
use Illuminate\Support\Facades\Response;
use App\models\Chutro;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // get all link in page
//        $crawler->filter('a')->each(function ($node) {
//            print $node->attr('href')."<br>";
//        });

//        $link = $crawler->selectLink('<label>Xem thêm bình luận</label>')->link();
//        dd($link);
//        echo "old: <br>";
//        $crawler->filter('.rd-des > span')->each(function ($node) {
//            echo $node->text()."<br>";
//        });
//        $crawler = $client->click($link);
//        echo "new: <br>";
//        $crawler->filter('.rd-des > span')->each(function ($node) {
//            echo $node->text()."<br>";
//        });
//        dd($uri = $link->getUri());

        return view('home');
    }

    public function getComment(Request $request){
        $client = new Client();
        $crawler = $client->request('GET', $request['link_post']);
        $tdata = "";
        $temp = $crawler->filter($request['structure'])->each(function ($node) {
            return $node->text() == "" ? "" : $node->text()."\r\n\r\n";
        });
        $points = $crawler->filter('.review-points > span')->each(function ($node) {
            return $node->text()."\r\n\r\n";
        });
        $array_last = [];
        for($i = 0; $i < count($temp); $i++){
           $temp[$i] == "" ? $array_last[$i] = "" : $array_last[$i] = $temp[$i]." ".$points[$i];
        }

        foreach ($array_last as $text)
        {
            $tdata .=$text;
        }
        $myName = "CommentFoody.txt";
        $headers = [
            'Content-type'=>'text/plain',
            'Content-Disposition'=>sprintf('attachment; filename="%s"', $myName),
        ];
        return Response::make($tdata, 200, $headers);
    }

    public function getCommentMultipleLink(Request $request){
        $client = new Client();
        $crawler = $client->request('GET', $request['all_link']);
        $data = "";
        $temp = $crawler->filter('ul>li>a')->each(function($node){
            return $node->attr('href');
        });

        dd($temp);
    }

    public function getAllLink(Request $request){
        $client = new Client();
        $crawler = $client->request('GET', $request['all_link']);
        $tdata = "";
        $temp = $crawler->filter('a.avatar')->each(function ($node) {
            return $node->attr('href')."\r\n\r\n";
        });

        foreach ($temp as $text)
        {
            $tdata .=$text;
        }
        $myName = "LinkPage.txt";
        $headers = [
            'Content-type'=>'text/plain',
            'Content-Disposition'=>sprintf('attachment; filename="%s"', $myName),
        ];
        return Response::make($tdata, 200, $headers);
    }
    private $tdata = '';
    private $words = [];
    public function getDefindWord(Request $request){
        set_time_limit(180);

        $client = new Client();
//        dd("https://vi.wiktionary.org/wiki/".$request['word']."#Tiếng_Việt");
        $word = preg_replace("/ /", "_", $request['word']);

        $this->showDetail($client, $word, 0);
//        dd($this->tdata);
        $myName = "DefineWord.txt";
        $headers = [
            'Content-type'=>'text/plain',
            'Content-Disposition'=>sprintf('attachment; filename="%s"', $myName),
        ];
        return Response::make($this->tdata, 200, $headers);
    }

    public function showDetail($client, $word, $counter){
        if($counter < 3 && !in_array($word,$this->words)) {
            array_push($this->words,$word);
            $crawler = $client->request('GET', "https://vi.wikipedia.org/wiki/" . $word);
            $this->tdata .= str_replace('_',' ',urldecode($word)) . "\r\n";
            $temp = $crawler->filter('#mw-content-text > .mw-parser-output > p')->each(function ($node) {
                return $node->text();
            });

            foreach ($temp as $text) {
                $this->tdata .= $text . "\r\n";
            }

            $this->tdata .= "\r\n --------------------- \r\n";
            $links = $crawler->filter('td.navbox-list > div > ul > li > a')->each(function ($node) {
                return $node->attr('href');
            });

            $titles = [];
            foreach ($links as $link) {
                if (preg_match('/\/w\//', $link) == false) {
                    $link = str_replace('/wiki/', '', $link);
                    array_push($titles, $link);
                }
            }

            foreach ($titles as $title) {
                $this->showDetail($client, $title, $counter+1);
            }
        }

    }

    public function products(){
        $origin = Input::get('origin');
        $destination = Input::get('destination');

        $url = urlencode ("http://localhost:8000/api/products");

        $json = json_decode(file_get_contents($url), true);

        dd($json);
    }
}