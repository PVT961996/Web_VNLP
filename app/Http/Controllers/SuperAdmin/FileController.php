<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Requests\Superadmin\CreateFileRequest;
use App\Http\Requests\Superadmin\UpdateFileRequest;
use App\Repositories\Superadmin\DocumentFileRepository;
use App\Repositories\Superadmin\FileRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Superadmin\SentenceRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Repositories\Superadmin\DocumentRepository;

class FileController extends AppBaseController
{
    /** @var  FileRepository */
    private $fileRepository;
    private $documentRepository;
    private $sentenceRepository;
    private $documentFileRepository;

    public function __construct(FileRepository $fileRepo, DocumentRepository $docRepo, SentenceRepository $sentenceRepo, DocumentFileRepository $documentFileRepo)
    {
        $this->fileRepository = $fileRepo;
        $this->documentRepository = $docRepo;
        $this->sentenceRepository = $sentenceRepo;
        $this->documentFileRepository = $documentFileRepo;
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
                $temp = $this->fileRepository->search($searchCondition, $search['document_id']);
                $files = $temp->orderBy('files.updated_at', 'desc')->paginate(16, ['files.*']);
            } else {
                $temp = $this->fileRepository->search($searchCondition);
                $files = $temp->orderBy('files.updated_at', 'desc')->paginate(16, ['files.*']);
            }
        } else {
            $files = $this->fileRepository->with('documents')->orderBy('updated_at', 'desc')->paginate(15);

//        $files = $this->fileRepository->orderBy('updated_at', 'desc')->findByField('id', '<>', 0, ['*'], true, 10);

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

        $file = $this->fileRepository->create($input);

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

        if (empty($file)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.files.index'));
        }

        return view('superadmin.files.show')->with('file', $file);
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
        $categories = $this->documentRepository->all();
        $selectedCategories = $this->documentFileRepository->findByField('file_id', '=', $id, ['document_id'], false)->toArray();
        $arr = [];
        foreach ($selectedCategories as $selectedCategory) {
            array_push($arr, $selectedCategory['document_id']);
        }
        $selectedCategories = $arr;

        if (empty($file)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.files.index'));
        }

        return view('superadmin.files.edit', compact('file', 'categories', 'selectedCategories'));
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

        if (empty($file)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.files.index'));
        }
        $request["description"] = strip_tags($request["description"]);
        $request["content"] = strip_tags($request["content"]);
        $file = $this->fileRepository->update($request->all(), $id);
        Flash::success(__('messages.updated'));

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
    }
}
