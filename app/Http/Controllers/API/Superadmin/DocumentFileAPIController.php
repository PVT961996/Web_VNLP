<?php

namespace App\Http\Controllers\API\Superadmin;

use App\Http\Requests\API\Superadmin\CreateDocumentFileAPIRequest;
use App\Http\Requests\API\Superadmin\UpdateDocumentFileAPIRequest;
use App\Models\Superadmin\DocumentFile;
use App\Repositories\Superadmin\DocumentFileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DocumentFileController
 * @package App\Http\Controllers\API\Superadmin
 */

class DocumentFileAPIController extends AppBaseController
{
    /** @var  DocumentFileRepository */
    private $documentFileRepository;

    public function __construct(DocumentFileRepository $documentFileRepo)
    {
        $this->documentFileRepository = $documentFileRepo;
    }

    /**
     * Display a listing of the DocumentFile.
     * GET|HEAD /documentFiles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->documentFileRepository->pushCriteria(new RequestCriteria($request));
        $this->documentFileRepository->pushCriteria(new LimitOffsetCriteria($request));
        $documentFiles = $this->documentFileRepository->all();

        return $this->sendResponse($documentFiles->toArray(), 'Document Files retrieved successfully');
    }

    /**
     * Store a newly created DocumentFile in storage.
     * POST /documentFiles
     *
     * @param CreateDocumentFileAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentFileAPIRequest $request)
    {
        $input = $request->all();

        $documentFiles = $this->documentFileRepository->create($input);

        return $this->sendResponse($documentFiles->toArray(), 'Document File saved successfully');
    }

    /**
     * Display the specified DocumentFile.
     * GET|HEAD /documentFiles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DocumentFile $documentFile */
        $documentFile = $this->documentFileRepository->findWithoutFail($id);

        if (empty($documentFile)) {
            return $this->sendError('Document File not found');
        }

        return $this->sendResponse($documentFile->toArray(), 'Document File retrieved successfully');
    }

    /**
     * Update the specified DocumentFile in storage.
     * PUT/PATCH /documentFiles/{id}
     *
     * @param  int $id
     * @param UpdateDocumentFileAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentFileAPIRequest $request)
    {
        $input = $request->all();

        /** @var DocumentFile $documentFile */
        $documentFile = $this->documentFileRepository->findWithoutFail($id);

        if (empty($documentFile)) {
            return $this->sendError('Document File not found');
        }

        $documentFile = $this->documentFileRepository->update($input, $id);

        return $this->sendResponse($documentFile->toArray(), 'DocumentFile updated successfully');
    }

    /**
     * Remove the specified DocumentFile from storage.
     * DELETE /documentFiles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DocumentFile $documentFile */
        $documentFile = $this->documentFileRepository->findWithoutFail($id);

        if (empty($documentFile)) {
            return $this->sendError('Document File not found');
        }

        $documentFile->delete();

        return $this->sendResponse($id, 'Document File deleted successfully');
    }
}
