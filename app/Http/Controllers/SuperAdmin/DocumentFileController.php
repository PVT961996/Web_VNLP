<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Requests\Superadmin\CreateDocumentFileRequest;
use App\Http\Requests\Superadmin\UpdateDocumentFileRequest;
use App\Repositories\Superadmin\DocumentFileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DocumentFileController extends AppBaseController
{
    /** @var  DocumentFileRepository */
    private $documentFileRepository;

    public function __construct(DocumentFileRepository $documentFileRepo)
    {
        $this->documentFileRepository = $documentFileRepo;
    }

    /**
     * Display a listing of the DocumentFile.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->documentFileRepository->pushCriteria(new RequestCriteria($request));
        $documentFiles = $this->documentFileRepository->all();

        return view('superadmin.document_files.index')
            ->with('documentFiles', $documentFiles);
    }

    /**
     * Show the form for creating a new DocumentFile.
     *
     * @return Response
     */
    public function create()
    {
        return view('superadmin.document_files.create');
    }

    /**
     * Store a newly created DocumentFile in storage.
     *
     * @param CreateDocumentFileRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentFileRequest $request)
    {
        $input = $request->all();

        $documentFile = $this->documentFileRepository->create($input);

        Flash::success('Document File saved successfully.');

        return redirect(route('superadmin.documentFiles.index'));
    }

    /**
     * Display the specified DocumentFile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $documentFile = $this->documentFileRepository->findWithoutFail($id);

        if (empty($documentFile)) {
            Flash::error('Document File not found');

            return redirect(route('superadmin.documentFiles.index'));
        }

        return view('superadmin.document_files.show')->with('documentFile', $documentFile);
    }

    /**
     * Show the form for editing the specified DocumentFile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $documentFile = $this->documentFileRepository->findWithoutFail($id);

        if (empty($documentFile)) {
            Flash::error('Document File not found');

            return redirect(route('superadmin.documentFiles.index'));
        }

        return view('superadmin.document_files.edit')->with('documentFile', $documentFile);
    }

    /**
     * Update the specified DocumentFile in storage.
     *
     * @param  int              $id
     * @param UpdateDocumentFileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentFileRequest $request)
    {
        $documentFile = $this->documentFileRepository->findWithoutFail($id);

        if (empty($documentFile)) {
            Flash::error('Document File not found');

            return redirect(route('superadmin.documentFiles.index'));
        }

        $documentFile = $this->documentFileRepository->update($request->all(), $id);

        Flash::success('Document File updated successfully.');

        return redirect(route('superadmin.documentFiles.index'));
    }

    /**
     * Remove the specified DocumentFile from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $documentFile = $this->documentFileRepository->findWithoutFail($id);

        if (empty($documentFile)) {
            Flash::error('Document File not found');

            return redirect(route('superadmin.documentFiles.index'));
        }

        $this->documentFileRepository->delete($id);

        Flash::success('Document File deleted successfully.');

        return redirect(route('superadmin.documentFiles.index'));
    }
}
