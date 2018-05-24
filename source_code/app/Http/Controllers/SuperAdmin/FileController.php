<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Requests\Superadmin\CreateFileRequest;
use App\Http\Requests\Superadmin\UpdateFileRequest;
use App\Repositories\Superadmin\DocumentFileRepository;
use App\Repositories\Superadmin\FileRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Superadmin\OfferPostRepository;
use App\Repositories\Superadmin\SentenceRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Repositories\Superadmin\DocumentRepository;
use App\Helpers\Helper;

class FileController extends AppBaseController
{
    /** @var  FileRepository */
    private $fileRepository;
    private $documentRepository;
    private $sentenceRepository;
    private $documentFileRepository;
    private $offerPostRepository;

    public function __construct(FileRepository $fileRepo, DocumentRepository $docRepo, SentenceRepository $sentenceRepo, DocumentFileRepository $documentFileRepo, OfferPostRepository $offerPostRepo)
    {
        $this->fileRepository = $fileRepo;
        $this->documentRepository = $docRepo;
        $this->sentenceRepository = $sentenceRepo;
        $this->documentFileRepository = $documentFileRepo;
        $this->offerPostRepository = $offerPostRepo;
    }

    /**
     * Display a listing of the File.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fileRepository->pushCriteria(new RequestCriteria($request));
        $documents = $this->documentRepository->getAllForSelectBox(['*'], null, true);
        $search = $request->search;
        $searchCondition = [];
        if (!empty($search)) {
            if (!empty($search['content'])) {
                array_push($searchCondition, ['content', 'LIKE', '%' . $search['content'] . '%']);
            }
            if (!empty($search['document_id']) && $search['document_id'] != 0) {
                $files = $this->fileRepository->search($searchCondition, $search['document_id']);
            } else {
                $files = $this->fileRepository->search($searchCondition);
            }
        } else {
            $files = $this->fileRepository->with('documents')->orderBy('updated_at', 'desc')->paginate(15);
        }
        return view('superadmin.files.index', compact('files', 'documents'));
    }

    /**
     * Show the form for creating a new File.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->documentRepository->all();
        $selectedCategories = null;
        $on_create = true;

        return view('superadmin.files.create', compact('categories', 'selectedCategories', 'on_create'));
    }

    /**
     * Store a newly created File in storage.
     *
     * @param CreateFileRequest $request
     *
     * @return Response
     */
    public function store(CreateFileRequest $request)
    {
        $input = $request->all();
        if ($request->documents == null) {
            Flash::error(__('messages.document_flash_select_category'));
            return back()->withInput();
        }
        $input['user_id'] = Auth::user()->id;
        $input["description"] = strip_tags($input["description"]);
        $input["content"] = strip_tags($input["content"]);
        if ($input['documents'][0] == 1) {
            $output_file = "";
            if (!empty($request->file)) {
                $file = time() . '.' . Helper::transText($request->file->getClientOriginalName(), '-');
                $request->file->move(public_path('files'), $file);
                $input['file'] = '/files/' . $file;
                $output_file = 'output_' . time() . '.' . Helper::transText($request->file->getClientOriginalName(), '-');
            }
            exec('java -jar D:/2018/KHOALUAN/Web_VNLP/source_code/public/libs/vitk-tok-5.1.jar D:/2018/KHOALUAN/Web_VNLP/source_code/public/' . $input['file'] . ' D:/2018/KHOALUAN/Web_VNLP/source_code/public/files/' . $output_file);

            $fp = @fopen('files/' . $output_file, "r");
            if ($fp) {
                if (filesize('files/' . $output_file) > 0) {
                    $data = fread($fp, filesize('files/' . $output_file));

                    $datas = explode(' ', $data);
                    foreach ($datas as $key => $value) {
                        $datas[$key] = preg_replace("/\/.*/", '', $value);
                    }
                    $input['content'] = "";
                    foreach ($datas as $key => $value) {
                        $input['content'] .= $value . " ";
                    }
                    fclose($fp);
                }
            } else {
                echo "fail";
            }
        }

//        if ($input['documents'][0] == 2) {
//            $fp = @fopen('files/demo2.txt', "w");
//            // Kiểm tra file mở thành công không
//            $input["content"] = strip_tags($input["content"]);
////            $input["content"] = iconv("ASCII//TRANSLIT", "UTF-8", $input["content"]);
//            $input['content'] = urldecode($input['content']);
////            dd($request);
//            dd(urldecode($input['content']));
//            if (!$fp) {
//                echo 'Mở file không thành công';
//            } else {
//                fwrite($fp, $input['content']);
//            }
//            exec('java -jar D:/2018/KHOALUAN/Web_VNLP/source_code/public/libs/vitk-pos-5.1.jar C:\Users\thanh\Desktop\demo2.txt C:\Users\thanh\Desktop\output.txt', $result);
//            dd($result);
//            $fp = @fopen('files/demo2.txt', "r");
//            if ($fp) {
//                if (filesize('files/' . $output_file) > 0) {
//                    $data = fread($fp, filesize('files/' . $output_file));
//
//                    $datas = explode(' ', $data);
//                    foreach ($datas as $key => $value) {
//                        $datas[$key] = preg_replace("/\/.*/", '', $value);
//                    }
//                    $input['content'] = "";
//                    foreach ($datas as $key => $value) {
//                        $input['content'] .= $value . " ";
//                    }
//                    fclose($fp);
//                }
//            } else {
//                echo "fail";
//            }
//        }

//        exec('java -jar D:/2018/KHOALUAN/Web_VNLP/public/libs/vitk-cus.jar "Đội tuyển U23 Việt Nam vô địch." D:/2018/KHOALUAN/Web_VNLP/public/files/output2.txt', $output);
//        print_r($output[0]);
//        $file = $this->fileRepository->create($input);

        Flash::success(__('messages.created'));

        return redirect(route('superadmin.files.index'));
    }

    /**
     * Display the specified File.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $file = $this->fileRepository->findWithoutFail($id);
        $output = "";

        if ($file->documents[0]->type == 3) {
            $words = explode(' ', $file->content);
            $att = "data-jstree='{" . '"opened"' . ":true," . '"icon"' . ':"/img/none.png"' . "}'";//trick
            foreach ($words as $word) {
                if ($word == "(") {
                    $output = $output . "<ul><li " . $att . ">";
                } else if ($word == ")") {
                    $output = $output . "</li></ul>";
                } else {
                    $output = $output . " " . $word;
                }
            }
        }
        if (empty($file)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.files.index'));
        }

        return view('superadmin.files.show', compact('file', 'output'));
    }

    private $rank = 0;

    function buildTree($data, $index, $tree, $rank)
    {
        echo $index . ' ';
        if ($index < count($data)) {
            if ($data[$index] == '(') {
                $this->rank++;
                $tree = array($data[$index + 1] => $this->buildTree($data, $index + 1, $tree, ''));
                if ($rank == 'add') {
                    echo 'add';
                    array_add($tree, $data[$index + 1], $data[$index + 2]);
                }
            } elseif ($data[$index] == ')') {
                $this->rank--;
                if ($data[$index - 1] != ')') {
                    $tree = array($data[$index - 2] => $data[$index - 1]);
                    if ($data[$index + 1] == '(')
                        $this->buildTree($data, $index + 1, $tree, 'add');
//                    dd($tree);
                } else
                    $tree = $this->buildTree($data, $index + 1, $tree, '');
            } else {
                $tree = $this->buildTree($data, $index + 1, $tree, '');
            }
        }
        return $tree;
    }

    /**
     * Show the form for editing the specified File.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $file = $this->fileRepository->findWithoutFail($id);
        if (Auth::user()->id == $file->user->id) {
            $words = explode(' ', $file->content);
            $categories = $this->documentRepository->all();
            $selectedCategories = $this->documentFileRepository->findByField('file_id', '=', $id, ['document_id'], false)->toArray();
            $arr = [];
            foreach ($selectedCategories as $selectedCategory) {
                array_push($arr, $selectedCategory['document_id']);
            }
            $selectedCategories = $arr;

            $output = "";

            if ($file->documents[0]->type == 3) {
                $words = explode(' ', $file->content);
                $att = "data-jstree='{" . '"opened"' . ":true," . '"icon"' . ':"/img/none.png"' . "}'";//trick
                foreach ($words as $word) {
                    if ($word == "(") {
                        $output = $output . "<ul><li " . $att . ">";
                    } else if ($word == ")") {
                        $output = $output . "</li></ul>";
                    } else {
                        $output = $output . " " . $word;
                    }
                }
            }

            if (empty($file)) {
                Flash::error(__('messages.not-found'));
                return redirect(route('superadmin.files.index'));
            }
            return view('superadmin.files.edit', compact('file', 'categories', 'selectedCategories', 'words', 'output'));
        } else {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.files.index'));
        }
    }

    /**
     * Update the specified File in storage.
     *
     * @param  int $id
     * @param UpdateFileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFileRequest $request)
    {
        $file = $this->fileRepository->findWithoutFail($id);
        if (Auth::user()->id == $file->user->id) {
            if (empty($file)) {
                Flash::error(__('messages.not-found'));
                return redirect(route('superadmin.files.index'));
            }
            $request["description"] = strip_tags($request["description"]);
            $request["content"] = strip_tags($request["content"]);
            if ($file->documents[0]->type == 3) {
                $request["content"] = str_replace("(", " ( ", $request["content"]);
                $request["content"] = str_replace(")", " ) ", $request["content"]);
                $request["content"] = preg_replace("/\s+/", " ", $request["content"]);
                $request["content"] = trim($request["content"]);
            }
            $file = $this->fileRepository->update($request->all(), $id);
            Flash::success(__('messages.updated'));

            return redirect(route('superadmin.files.index'));
        } else {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.files.index'));
        }
    }

    public function offer($id){
        $file = $this->fileRepository->findWithoutFail($id);
        return view('superadmin.files.offer',compact('file'));
    }
    public function edit_offer(Request $request)
    {
        $input = $request->all();
        $this->offerPostRepository->create(['content' => $input['content'], 'status' => 0, 'file_id' => $input['id']]);
        return redirect(route('superadmin.files.index'));
    }
    /**
     * Remove the specified File from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $file = $this->fileRepository->findWithoutFail($id);
        if (Auth::user()->id == $file->user->id) {
            if ($id == 'MULTI') {
                if (empty($request->ids)) Flash::error(__('messages.not-found'));
                else {
                    foreach ($request->ids as $id) {
                        $files = $this->fileRepository->findWithoutFail($id);

                        if (empty($files)) {
                            Flash::error(__('messages.not-found'));

                            return redirect(route('superadmin.files.index'));
                        }
                        $sentences = $this->sentenceRepository->findByField('file_id', '=', [$id], ['*'], true, 10);
                        foreach ($sentences as $sentence) {
                            $this->sentenceRepository->delete($sentence->id);
                        }
                        $document_files = $this->documentFileRepository->findByField('file_id', '=', [$id], ['*']);
                        foreach ($document_files as $document_file) {
                            $this->documentFileRepository->delete($document_file->id);
                        }
                        $this->fileRepository->delete($id);
                    }

                    Flash::success(__('messages.deleted'));
                }
            } else {
                $file = $this->fileRepository->findWithoutFail($id);

                if (empty($file)) {
                    Flash::error('messages.no-items');

                    return redirect(route('superadmin.files.index'));
                }
                $sentences = $this->sentenceRepository->findByField('file_id', '=', [$id], ['*'], true, 10);
                foreach ($sentences as $sentence) {
                    $this->sentenceRepository->delete($sentence->id);
                }

                $document_files = $this->documentFileRepository->findByField('file_id', '=', [$id], ['*']);
                foreach ($document_files as $document_file) {
                    $this->documentFileRepository->delete($document_file->id);
                }
                $this->fileRepository->delete($id);

                Flash::success(__('messages.deleted'));
            }
            return redirect(route('superadmin.files.index'));
        } else {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.files.index'));
        }
    }

    public function evaluated(Request $request)
    {
        $input = $request->all();
        if (is_null($input['evaluated'])) {
            Flash::error(__('messages.not-found'));
        } else {
            $file = $this->fileRepository->findWithoutFail($input['id']);
            if ($input['evaluated'] == 0) {
                $file->like += 1;
            } elseif ($input['evaluated'] == 1) {
                $file->dislike += 1;
            } elseif ($input['evaluated'] == 2) {
                $file->neutral += 1;
            }
            $file->save();
            Flash::success(__('messages.updated'));
        }
        return redirect(route('superadmin.files.index'));
    }
}
