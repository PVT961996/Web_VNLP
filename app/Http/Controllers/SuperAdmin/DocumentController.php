<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Superadmin\CreateDocumentRequest;
use App\Http\Requests\Superadmin\UpdateDocumentRequest;
use App\Repositories\Superadmin\CategoryDocRepository;
use App\Repositories\Superadmin\DocumentCategoryRepository;
use App\Repositories\Superadmin\DocumentRepository;
use App\Repositories\Superadmin\FileRepository;
use App\Repositories\Superadmin\SentenceRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class DocumentController extends AppBaseController
{
    /** @var  DocumentRepository */
    private $documentRepository;
    private $fileRepository;
    private $sentenceRepository;
    private $categoryDocRepository;
    private $docCategoryRepository;

    public function __construct(DocumentRepository $documentRepo, FileRepository $fileRepo, SentenceRepository $sentenceRepo, CategoryDocRepository $categoryDocRepo, DocumentCategoryRepository $docCategoryRepo)
    {
        $this->documentRepository = $documentRepo;
        $this->fileRepository = $fileRepo;
        $this->sentenceRepository = $sentenceRepo;
        $this->categoryDocRepository = $categoryDocRepo;
        $this->docCategoryRepository = $docCategoryRepo;
    }

    /**
     * Display a listing of the Document.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $searchCondition = [];
        if (!empty($search)) {
            if (!empty($search['name'])) {
                array_push($searchCondition, ['name', 'LIKE', '%' . $search['name'] . '%']);
            }
            if (!empty($search['source'])) {
                array_push($searchCondition, ['source', 'LIKE', '%' . $search['source'] . '%']);
            }
            $documents = $this->documentRepository->search($searchCondition);
        } else {
            $documents = $this->documentRepository->orderBy('updated_at', 'DESC')->paginate(10);
        }

        return view('superadmin.documents.index')
            ->with('documents', $documents);
    }

    /**
     * Show the form for creating a new Document.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryDocRepository->buildTree(['id', 'name']);
        $selectedCategories = null;
        $on_create = true;
        return view('superadmin.documents.create', compact('categories', 'selectedCategories', 'on_create'));
    }

    /**
     * Store a newly created Document in storage.
     *
     * @param CreateDocumentRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentRequest $request)
    {
        $input = $request->all();
        if ($request->categories == null) {
            Flash::error(__('messages.document_flash_select_category'));
            return back()->withInput();
        }
        $input["user_id"] = Auth::user()->id;
        $input["description"] = strip_tags($input["description"]);
        $input["short_description"] = strip_tags($input["short_description"]);

        $document = $this->documentRepository->create($input);

        Flash::success(__('messages.created'));

        return redirect(route('superadmin.documents.index'));
    }

    /**
     * Display the specified Document.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.documents.index'));
        }

        return view('superadmin.documents.show')->with('document', $document);
    }

    /**
     * Show the form for editing the specified Document.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.documents.index'));
        }

        return view('superadmin.documents.edit')->with('document', $document);
    }

    /**
     * Update the specified Document in storage.
     *
     * @param  int $id
     * @param UpdateDocumentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentRequest $request)
    {
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.documents.index'));
        }
        $document["user_id"] = Auth::user()->id;
        $request["description"] = strip_tags($request["description"]);
        $request["short_description"] = strip_tags($request["short_description"]);
        $this->documentRepository->update($request->all(), $id);

        Flash::success(__('messages.updated'));

        return redirect(route('superadmin.documents.index'));
    }

    /**
     * Remove the specified Document from storage.
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
                    $documents = $this->documentRepository->findWithoutFail($id);

                    if (empty($documents)) {
                        Flash::error(__('messages.not-found'));

                        return redirect(route('superadmin.documents.index'));
                    }
                    if (!$documents->files->isEmpty()) {
                        Flash::warning(__('messages.document_contain_file_error'));
                        return back();
                    }
                    if (!$documents->offerPosts->isEmpty()) {
                        Flash::warning(__('messages.document_contain_offer_post_error'));
                        return back();
                    }
                    $documentCategories = $this->docCategoryRepository->findByField('document_id', '=', $id, ['*'], false);
                    foreach ($documentCategories as $documentCategory) {
                        $this->docCategoryRepository->delete($documentCategory->id);
                    }
                    $this->documentRepository->delete($id);
                }

                Flash::success(__('messages.deleted'));
            }
        } else {
            $document = $this->documentRepository->findWithoutFail($id);

            if (empty($document)) {
                Flash::error('messages.no-items');

                return redirect(route('superadmin.documents.index'));
            } elseif (!$document->files->isEmpty()) {
                Flash::warning(__('messages.document_contain_file_error'));
                return back();
            } elseif (!$document->offerPosts->isEmpty()) {
                Flash::warning(__('messages.document_contain_offer_post_error'));
                return back();
            }
            $documentCategories = $this->docCategoryRepository->findByField('document_id', '=', $id, ['*'], false);
            foreach ($documentCategories as $documentCategory) {
                $this->docCategoryRepository->delete($documentCategory->id);
            }
            $this->documentRepository->delete($id);

            Flash::success(__('messages.deleted'));
        }
        return redirect(route('superadmin.documents.index'));
    }

    public function readFile()
    {
        ini_set('memory_limit', '256M');
        $files = scandir('data/Tach_tu');
        set_time_limit(40*count($files));
        foreach ($files as $file){
            $this->recursiveFile('data/Tach_tu/'.$file,$file);
        }
    }

    public function recursiveFile($path, $file_name){
        $fp = @fopen($path, "r");
        // Kiểm tra file mở thành công không
        if (!$fp) {
            echo 'Mở file không thành công';
        } else {
            // Đọc file và trả về nội dung
            echo 'Mở file thành công';
            $data = fread($fp, filesize($path));
            $document = $this->documentRepository->create(['short_description' => $data, 'description' => $data, 'user_id' => Auth::user()->id, 'file' => $file_name, 'name' => $file_name]);
            $this->docCategoryRepository->create(['category_id' => 1, 'document_id' => $document->id]);
        }
    }
}
