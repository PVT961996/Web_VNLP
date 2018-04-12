<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Requests\Superadmin\CreateSentenceRequest;
use App\Http\Requests\Superadmin\UpdateSentenceRequest;
use App\Repositories\Superadmin\FileRepository;
use App\Repositories\Superadmin\SentenceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SentenceController extends AppBaseController
{
    /** @var  SentenceRepository */
    private $sentenceRepository;
    private $fileRepository;

    public function __construct(SentenceRepository $sentenceRepo, FileRepository $fileRepos)
    {
        $this->sentenceRepository = $sentenceRepo;
        $this->fileRepository = $fileRepos;
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

        return view('superadmin.sentences.show')->with('sentence', $sentence);
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
        $fileCorpus = $this->fileRepository->getAllFile();
        $selectedFile = $sentence->file_id;

        if (empty($sentence)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.sentences.index'));
        }

        return view('superadmin.sentences.edit', compact('fileCorpus', 'sentence', 'selectedFile'));
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

        if (empty($sentence)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.sentences.index'));
        }

        $sentence = $this->sentenceRepository->update($request->all(), $id);
        Flash::success(__('messages.updated'));
        return redirect(route('superadmin.sentences.index'));
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
    }
}
