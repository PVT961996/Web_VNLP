<?php

namespace App\Http\Controllers\API\Superadmin;

use App\Http\Requests\API\Superadmin\CreateDocumentAPIRequest;
use App\Http\Requests\API\Superadmin\UpdateDocumentAPIRequest;
use App\Models\Superadmin\Document;
use App\Repositories\Superadmin\DocumentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DocumentController
 * @package App\Http\Controllers\API\Superadmin
 */

class DocumentAPIController extends AppBaseController
{
    /** @var  DocumentRepository */
    private $documentRepository;

    public function __construct(DocumentRepository $documentRepo)
    {
        $this->documentRepository = $documentRepo;
    }

    /**
     * Display a listing of the Document.
     * GET|HEAD /documents
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->documentRepository->pushCriteria(new RequestCriteria($request));
        $this->documentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $documents = $this->documentRepository->all();

        return $this->sendResponse($documents->toArray(), 'Documents retrieved successfully');
    }

    /**
     * Store a newly created Document in storage.
     * POST /documents
     *
     * @param CreateDocumentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentAPIRequest $request)
    {
        $input = $request->all();

        $documents = $this->documentRepository->create($input);

        return $this->sendResponse($documents->toArray(), 'Document saved successfully');
    }

    /**
     * Display the specified Document.
     * GET|HEAD /documents/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Document $document */
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            return $this->sendError('Document not found');
        }

        return $this->sendResponse($document->toArray(), 'Document retrieved successfully');
    }

    /**
     * Update the specified Document in storage.
     * PUT/PATCH /documents/{id}
     *
     * @param  int $id
     * @param UpdateDocumentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Document $document */
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            return $this->sendError('Document not found');
        }

        $document = $this->documentRepository->update($input, $id);

        return $this->sendResponse($document->toArray(), 'Document updated successfully');
    }

    /**
     * Remove the specified Document from storage.
     * DELETE /documents/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Document $document */
        $document = $this->documentRepository->findWithoutFail($id);

        if (empty($document)) {
            return $this->sendError('Document not found');
        }

        $document->delete();

        return $this->sendResponse($id, 'Document deleted successfully');
    }
}
