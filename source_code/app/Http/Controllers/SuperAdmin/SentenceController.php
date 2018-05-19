<?php

namespace App\Http\Controllers\Superadmin;

use App\Helpers\Helper;
use App\Http\Requests\Superadmin\CreateSentenceRequest;
use App\Http\Requests\Superadmin\UpdateSentenceRequest;
use App\Repositories\Superadmin\FileRepository;
use App\Repositories\Superadmin\LabelTypeRepository;
use App\Repositories\Superadmin\SentenceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Auth;

class SentenceController extends AppBaseController
{
    /** @var  SentenceRepository */
    private $sentenceRepository;
    private $fileRepository;
    private $labelTypeRepository;

    public function __construct(SentenceRepository $sentenceRepo, FileRepository $fileRepos, LabelTypeRepository $labelTypeRepo)
    {
        $this->sentenceRepository = $sentenceRepo;
        $this->fileRepository = $fileRepos;
        $this->labelTypeRepository = $labelTypeRepo;
    }

    /**
     * Display a listing of the Sentence.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
//        ini_set('memory_limit', '-1');
        $this->sentenceRepository->pushCriteria(new RequestCriteria($request));
//        $fileCorpus = $this->fileRepository->getAllForSelectBoxFile(['*'], null, true);
        $search = $request->search;
        $searchCondition = [['id', '<>', 0]];
        if (!empty($search)) {
            if (!empty($search['content'])) {
                array_push($searchCondition, ['content', 'LIKE', '%' . $search['content'] . '%']);
            }
            if (!empty($search['file_id']) && $search['file_id'] != 0) {
                array_push($searchCondition, ['file_id', '=', $search['file_id']]);
            }
            $sentences = $this->sentenceRepository->orderBy('updated_at', 'desc')->search($searchCondition);
        } else {
            $sentences = $this->sentenceRepository->orderBy('updated_at', 'desc')->findByField('id', '<>', 0, ['*'], true, 10);
        }

        return view('superadmin.sentences.index', compact('sentences'));
    }

    /**
     * Show the form for creating a new Sentence.
     *
     * @return Response
     */
    public function create()
    {
//        $fileCorpus = $this->fileRepository->getAllFile();
        $selectedFile = null;
        return view('superadmin.sentences.create', compact('fileCorpus', 'selectedFile'));
    }

    /**
     * Store a newly created Sentence in storage.
     *
     * @param CreateSentenceRequest $request
     *
     * @return Response
     */
    public function store(CreateSentenceRequest $request)
    {
        $input = $request->all();
        $input["content"] = strip_tags($input["content"]);
        $sentence = $this->sentenceRepository->create($input);

        Flash::success(__('messages.created'));

        return redirect(route('superadmin.sentences.index'));
    }

    /**
     * Display the specified Sentence.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sentence = $this->sentenceRepository->findWithoutFail($id);

        if (empty($sentence)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.sentences.index'));
        }

        $output = "";

        if ($sentence->file->documents[0]->type == 3) {
            $words = explode(' ', $sentence->content);
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

        return view('superadmin.sentences.show', compact('sentence','output'));
    }

    /**
     * Show the form for editing the specified Sentence.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sentence = $this->sentenceRepository->findWithoutFail($id);
        if (Auth::user()->id == $sentence->file->user->id) {
            $words = explode(' ', $sentence->content);
            $arrs = [];
            if ($sentence->file->documents[0]->type == 1 && isset($sentence->file->documents[1]->type)) {
                $label_types = $this->labelTypeRepository->findByField('type', 0);
                foreach ($words as $word) {
                    $label = explode('/', $word);
                    array_push($arrs, $label[0], $label[1]);
//                $arr[$label[0]] = $label[1];
                }
//            dd($arrs);
            }
            $output = "";

            if ($sentence->file->documents[0]->type == 3) {
                $words = explode(' ', $sentence->content);
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
            $fileCorpus = $this->fileRepository->getAllFile();
            $selectedFile = $sentence->file_id;

            if (empty($sentence)) {
                Flash::error(__('messages.not-found'));
                return redirect(route('superadmin.sentences.index'));
            }

            return view('superadmin.sentences.edit', compact('fileCorpus', 'sentence', 'selectedFile', 'words', 'arrs', 'label_types','output'));
        } else {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.sentences.index'));
        }
    }

    public function edit_high($id)
    {
        $sentence = $this->sentenceRepository->findWithoutFail($id);
        $words = explode(' ', $sentence->content);

        $fileCorpus = $this->fileRepository->getAllFile();
        $selectedFile = $sentence->file_id;

        if (empty($sentence)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.sentences.index'));
        }

        return view('superadmin.sentences.edit_high', compact('fileCorpus', 'sentence', 'selectedFile', 'words'));
    }

    /**
     * Update the specified Sentence in storage.
     *
     * @param  int $id
     * @param UpdateSentenceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSentenceRequest $request)
    {
        $sentence = $this->sentenceRepository->findWithoutFail($id);
        if (Auth::user()->id == $sentence->file->user->id) {
            if (empty($sentence)) {
                Flash::error(__('messages.not-found'));
                return redirect(route('superadmin.sentences.index'));
            }
            $request["content"] = strip_tags($request["content"]);
            if ($sentence->file->documents[0]->type == 3) {
                $request["content"] = str_replace("(", " ( ", $request["content"]);
                $request["content"] = str_replace(")", " ) ", $request["content"]);
                $request["content"] = preg_replace("/\s+/", " ", $request["content"]);
                $request["content"] = trim($request["content"]);
            }
            $sentence = $this->sentenceRepository->update($request->all(), $id);
            Flash::success(__('messages.updated'));
            return redirect(route('superadmin.sentences.index'));
        } else {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.sentences.index'));
        }
    }

    public function update_high($id, UpdateSentenceRequest $request)
    {
        $input = $request->all();
        $sentence = $this->sentenceRepository->findWithoutFail($id);
        if (empty($sentence)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.sentences.index'));
        }
//        $request["content"] = strip_tags($request["content"]);
        $fp = @fopen('files/demo.txt', "w");
        // Kiểm tra file mở thành công không
        if (!$fp) {
            echo 'Mở file không thành công';
        } else {
            fwrite($fp, $input['content']);
        }
        exec('javac D:/SetUp/eclipse/workspace/PhuongLHClient/src/MyClient.java');
        exec('java -cp D:/SetUp/eclipse/workspace/PhuongLHClient/src MyClient "D:/2018/KHOALUAN/Web_VNLP/source_code/public/files/demo.txt"',$output);
//        exec('java -jar D:/2018/KHOALUAN/Web_VNLP/source_code/public/libs/vitk-tok-5.1.jar D:/2018/KHOALUAN/Web_VNLP/source_code/public/files/demo.txt D:/2018/KHOALUAN/Web_VNLP/source_code/public/files/output.txt');
//        $fp = @fopen('files/output.txt', "r");
//        if ($fp) {
//            if (filesize('files/output.txt') > 0) {
//                $data = fread($fp, filesize('files/output.txt'));
//
//                $datas = explode(' ', $data);
//                foreach ($datas as $key => $value) {
//                    $datas[$key] = preg_replace("/\/.*/", '', $value);
//                }
//                $input['content'] = "";
//                foreach ($datas as $key => $value) {
//                    $input['content'] .= $value . " ";
//                }
//                fclose($fp);
//            }
//        } else {
//            echo "fail";
//        }
        $sentence->content = $output[0];
        $sentence->save();
//        $sentence = $this->sentenceRepository->update($input, $id);
        Flash::success(__('messages.updated'));
        return redirect(route('superadmin.sentences.edit_high', [$id]));
    }


    /**
     * Remove the specified Sentence from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $sentence = $this->sentenceRepository->findWithoutFail($id);
        if (Auth::user()->id == $sentence->file->user->id) {
            if ($id == 'MULTI') {
                if (empty($request->ids)) Flash::error(__('messages.not-found'));
                else {
                    foreach ($request->ids as $id) {
                        $sentences = $this->sentenceRepository->findWithoutFail($id);

                        if (empty($files)) {
                            Flash::error(__('messages.not-found'));

                            return redirect(route('superadmin.files.index'));
                        }
                        $this->sentenceRepository->delete($id);
                    }

                    Flash::success(__('messages.deleted'));
                }
            } else {
                $sentence = $this->sentenceRepository->findWithoutFail($id);

                if (empty($file)) {
                    Flash::error('messages.no-items');

                    return redirect(route('superadmin.files.index'));
                }
                $this->sentenceRepository->delete($id);

                Flash::success(__('messages.deleted'));
            }
            return redirect(route('superadmin.sentences.index'));
        } else {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.sentences.index'));
        }
    }
}
