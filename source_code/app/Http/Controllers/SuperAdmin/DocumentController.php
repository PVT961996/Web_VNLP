<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Superadmin\CreateDocumentRequest;
use App\Http\Requests\Superadmin\UpdateDocumentRequest;
use App\Repositories\Superadmin\CategoryDocRepository;
use App\Repositories\Superadmin\DocumentCategoryRepository;
use App\Repositories\Superadmin\DocumentFileRepository;
use App\Repositories\Superadmin\DocumentRepository;
use App\Repositories\Superadmin\FileRepository;
use App\Repositories\Superadmin\SentenceRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use FilesystemIterator;
use Illuminate\Support\Facades\DB;

class DocumentController extends AppBaseController
{
    /** @var  DocumentRepository */
    private $documentRepository;
    private $fileRepository;
    private $sentenceRepository;
    private $categoryDocRepository;
    private $docCategoryRepository;
    private $docFileRepository;

    public function __construct(DocumentRepository $documentRepo, FileRepository $fileRepo, SentenceRepository $sentenceRepo, CategoryDocRepository $categoryDocRepo, DocumentCategoryRepository $docCategoryRepo, DocumentFileRepository $docFileRepo)
    {
        $this->documentRepository = $documentRepo;
        $this->fileRepository = $fileRepo;
        $this->sentenceRepository = $sentenceRepo;
        $this->categoryDocRepository = $categoryDocRepo;
        $this->docCategoryRepository = $docCategoryRepo;
        $this->docFileRepository = $docFileRepo;
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
        $categories = $request['danh-muc'];
        $searchCondition = [];
        if (!empty($search)) {
            if (!empty($search['name'])) {
                array_push($searchCondition, ['name', 'LIKE', '%' . $search['name'] . '%']);
            }
            if (!empty($search['source'])) {
                array_push($searchCondition, ['source', 'LIKE', '%' . $search['source'] . '%']);
            }
            if (!empty($search['category_id']) && $search['category_id'] != 0) {
                $documents = $this->documentRepository->search($searchCondition, $search['category_id']);
            } else {
                $documents = $this->documentRepository->search($searchCondition);
            }
        } else {
            $documents = $this->documentRepository->with('categories')->paginate(16);
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
        if (Auth::user()->id == $document->file->user->id) {
            $categories = $this->categoryDocRepository->buildTree(['id', 'name']);
            $selectedCategories = $this->docCategoryRepository->findByField('document_id', '=', $id, ['category_id'], false)->toArray();
            $arr = [];
            foreach ($selectedCategories as $selectedCategory) {
                array_push($arr, $selectedCategory['category_id']);
            }
            $selectedCategories = $arr;
            if (empty($document)) {
                Flash::error(__('messages.not-found'));
                return redirect(route('superadmin.documents.index'));
            }
            return view('superadmin.documents.edit', compact('document', 'categories', 'selectedCategories'));
        } else {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.documents.index'));
        }
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
        if ($request->categories == null) {
            Flash::error(__('messages.document_flash_select_category'));
            return back()->withInput();
        }

        $document = $this->documentRepository->findWithoutFail($id);
        if (Auth::user()->id == $document->user->id) {
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
        } else {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.documents.index'));
        }
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
        $document = $this->documentRepository->findWithoutFail($id);
        if (Auth::user()->id == $document->user->id) {
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
        else {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.documents.index'));
        }
    }

    public function readFileGrammar()
    {
        ini_set('memory_limit', '512M');
        $files = scandir('data/Cay_cu_phap');
        set_time_limit(40 * count($files));
        foreach ($files as $file) {
//             doc file, luu file
//            dong file
            if (preg_match('/raw$/', $file)) {
                echo "ok";
                $fp = @fopen('data/Cay_cu_phap/' . $file, "r");
                if ($fp) {
                    echo "ok";
                    if (filesize('data/Cay_cu_phap/' . $file) > 0) {
                        $data = fread($fp, filesize('data/Cay_cu_phap/' . $file));
                        $file_db = $this->fileRepository->create(['name' => $file, 'summary' => $file, 'content' => $data, 'description' => $data, 'file' => '/data/Cay_cu_phap/' . $file, 'user_id' => Auth::user()->id]);
                        $this->docFileRepository->create(['file_id' => $file_db->id, 'document_id' => 5]);
                        fclose($fp);
                        $this->recursiveFile('data/Cay_cu_phap/' . $file, $file_db->id);
                    }
                } else {
                    echo "fail";
                }
            } else {
                $this->recursiveFileGrammar('data/Cay_cu_phap/' . $file, $file);
            }
        }
    }

    public function readFile()
    {
//        $fi = new FilesystemIterator('data/Gan_nhan_tu_loai/', FilesystemIterator::SKIP_DOTS);
//        printf("There were %d Files", iterator_count($fi));

        ini_set('memory_limit', '512M');
        $files = scandir('data/Gan_nhan_tu_loai');
        set_time_limit(40 * count($files));
        foreach ($files as $file) {
//             doc file, luu file
//            dong file
            $fp = @fopen('data/Gan_nhan_tu_loai/' . $file, "r");
            if ($fp) {
                echo "ok";
                if (filesize('data/Gan_nhan_tu_loai/' . $file) > 0) {
                    $data = fread($fp, filesize('data/Gan_nhan_tu_loai/' . $file));
                    $file_db = $this->fileRepository->create(['name' => $file, 'summary' => $file, 'content' => $data, 'description' => $data, 'file' => '/data/Gan_nhan_tu_loai/' . $file, 'user_id' => Auth::user()->id]);
                    $this->docFileRepository->create(['file_id' => $file_db->id, 'document_id' => 1]);
                    $this->docFileRepository->create(['file_id' => $file_db->id, 'document_id' => 2]);
                    fclose($fp);
                    $this->recursiveFile('data/Gan_nhan_tu_loai/' . $file, $file_db->id);
                }
            } else {
                echo "fail";
            }

        }
    }

    public function readFileSeperate()
    {
        ini_set('memory_limit', '512M');
        $files = scandir('data/Tach_tu');
        set_time_limit(40 * count($files));
        foreach ($files as $file) {
            $this->recursiveFileSeperate('data/Tach_tu/' . $file, $file);
        }
    }

    //TODO Gán nhãn từ loại
    public function recursiveFile($path, $file_id)
    {
        $fp = @fopen($path, "r");
        // Kiểm tra file mở thành công không
        if ($fp) {
            echo 'Mở file thành công <br>';
            if (filesize($path) > 0) {
                while (($buffer = fgets($fp)) !== false) {
                    $this->sentenceRepository->create(['content' => $buffer, 'file_id' => $file_id]);
                    echo $buffer;
                }
                if (!feof($fp)) {
                    echo "Error: unexpected fgets() fail\n";
                }
                fclose($fp);
            }
        }


//        if (!$fp) {
//            echo 'Mở file không thành công <br>';
//        } else {
//            if (filesize($path) > 0) {
//                DB::beginTransaction();
//                try {
//                    $data = fread($fp, filesize($path));
//                    $file = $this->fileRepository->create(['name' => $file_name, 'summary' => $file_name, 'content' => $data, 'description' => $data, 'user_id' => Auth::user()->id]);
//                    $this->docFileRepository->create(['file_id' => $file->id, 'document_id' => 1]);
//                    $this->docFileRepository->create(['file_id' => $file->id, 'document_id' => 2]);
//
//                    // Đọc file và trả về nội dung
//                    echo 'Mở file thành công <br>';
//                    while (($buffer = fgets($fp, 4096)) !== false) {
//                        echo('hhh' . $buffer . '<br>');
//                        $this->sentenceRepository->create(['content' => $buffer, 'file_id' => $file->id]);
//                    }
//                    if (!feof($fp)) {
//                        dd('jjjj');
//                    }
//
//                    fclose($fp);
//                } catch (\Exception $e) {
//                    DB::rollback();
//                    // something went wrong
//                }
//            }
//        }
    }

    //TODO Tách từ
    public function recursiveFileSeperate($path, $file_name)
    {
        $fp = @fopen($path, "r");
        // Kiểm tra file mở thành công không
        if (!$fp) {
            echo 'Mở file không thành công';
        } else {
            // Đọc file và trả về nội dung
            echo 'Mở file thành công';
            if (filesize($path) > 0) {
                $data = fread($fp, filesize($path));
                $file = $this->fileRepository->create(['name' => $file_name, 'summary' => $file_name, 'content' => $data, 'description' => $data, 'file' => '/data/Tach_tu/' . $file_name, 'user_id' => Auth::user()->id]);
                $this->docFileRepository->create(['file_id' => $file->id, 'document_id' => 1]);
            }
        }
    }

    //TODO: Cây cú pháp
    public function recursiveFileGrammar($path, $file_name)
    {
        $fp = @fopen($path, "r");
        // Kiểm tra file mở thành công không
        if (!$fp) {
            echo 'Mở file không thành công';
        } else {
            // Đọc file và trả về nội dung
            echo 'Mở file thành công';
            if (filesize($path) > 0) {
                $data = fread($fp, filesize($path));
                $file = $this->fileRepository->create(['name' => $file_name, 'summary' => $file_name, 'content' => $data, 'description' => $data, 'file' => '/data/Cay_cu_phap/' . $file_name, 'user_id' => Auth::user()->id]);
                $this->docFileRepository->create(['file_id' => $file->id, 'document_id' => 4]);
            }
        }
    }
}
