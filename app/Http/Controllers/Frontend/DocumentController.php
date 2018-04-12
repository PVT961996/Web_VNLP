<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Repositories\Superadmin\FileRepository;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Superadmin\CreateDocumentRequest;
use App\Http\Requests\Superadmin\UpdateDocumentRequest;
use App\Repositories\Superadmin\DocumentRepository;

class DocumentController extends FrontendBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $fileRepository;

    public function __construct(DocumentRepository $documentRepo, FileRepository $fileRepo)
    {
        parent::__construct($documentRepo);
        $this->fileRepository = $fileRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchCondition = [];
        $categoryId = (int)$request['danh-muc'];
        $documents = $this->getDocuments();
        $files = $this->fileRepository->orderBy('updated_at','desc')->search($searchCondition,$categoryId);
//        dd($files);
        return view('frontend.document.index',compact('documents','files'));
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