<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Repositories\Superadmin\CategoryDocRepository;
use App\Repositories\Superadmin\FileRepository;
use App\Repositories\Superadmin\FileUserRepository;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Superadmin\CreateDocumentRequest;
use App\Http\Requests\Superadmin\UpdateDocumentRequest;
use App\Repositories\Superadmin\DocumentRepository;

class HomePageController extends FrontendBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $fileRepository;
    private $fileUserRepository;

    public function __construct(DocumentRepository $documentRepo, FileRepository $fileRepo, CategoryDocRepository $cateDocRepo, FileUserRepository $fileUserRepo)
    {
        parent::__construct($documentRepo, $cateDocRepo);
        $this->fileRepository = $fileRepo;
        $this->fileUserRepository = $fileUserRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_docs = $this->cateDocRepository->all();
        $documents = $this->getDocuments();
        $files = $this->fileRepository->paginate(10);
        $recent_posts = $this->fileRepository->getRecentPost();
        if(Auth::user()){
            $file_users = $this->fileUserRepository->findByField('user_id','=',Auth::user()->id,['file_id','status'],false);
        }
        return view('frontend.homepage.index',compact('documents','files','recent_posts','category_docs','file_users'));
    }

    public function show($id)
    {
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('post'));
        }

        return view('frontend.post.show')->with('document', $document);
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
            return redirect(route('post'));
        }

        return view('frontend.post.edit')->with('document', $document);
    }

    /**
     * Update the specified Document in storage.
     *
     * @param  int              $id
     * @param UpdateDocumentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentRequest $request)
    {
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('post'));
        }
        $document["user_id"] = Auth::user()->id;
        $request["description"] = strip_tags($request["description"]);
        $request["short_description"] = strip_tags($request["short_description"]);
        $this->documentRepository->update($request->all(), $id);

        Flash::success(__('messages.updated'));

        return redirect(route('post'));
    }

}