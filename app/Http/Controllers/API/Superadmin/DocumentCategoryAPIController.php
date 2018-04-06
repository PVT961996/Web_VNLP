<?php

namespace App\Http\Controllers\API\Superadmin;

use App\Http\Requests\API\Superadmin\CreateDocumentCategoryAPIRequest;
use App\Http\Requests\API\Superadmin\UpdateDocumentCategoryAPIRequest;
use App\Models\Superadmin\DocumentCategory;
use App\Repositories\Superadmin\DocumentCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DocumentCategoryController
 * @package App\Http\Controllers\API\Superadmin
 */

class DocumentCategoryAPIController extends AppBaseController
{
    /** @var  DocumentCategoryRepository */
    private $documentCategoryRepository;

    public function __construct(DocumentCategoryRepository $documentCategoryRepo)
    {
        $this->documentCategoryRepository = $documentCategoryRepo;
    }

    /**
     * Display a listing of the DocumentCategory.
     * GET|HEAD /documentCategories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->documentCategoryRepository->pushCriteria(new RequestCriteria($request));
        $this->documentCategoryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $documentCategories = $this->documentCategoryRepository->all();

        return $this->sendResponse($documentCategories->toArray(), 'Document Categories retrieved successfully');
    }

    /**
     * Store a newly created DocumentCategory in storage.
     * POST /documentCategories
     *
     * @param CreateDocumentCategoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentCategoryAPIRequest $request)
    {
        $input = $request->all();

        $documentCategories = $this->documentCategoryRepository->create($input);

        return $this->sendResponse($documentCategories->toArray(), 'Document Category saved successfully');
    }

    /**
     * Display the specified DocumentCategory.
     * GET|HEAD /documentCategories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DocumentCategory $documentCategory */
        $documentCategory = $this->documentCategoryRepository->findWithoutFail($id);

        if (empty($documentCategory)) {
            return $this->sendError('Document Category not found');
        }

        return $this->sendResponse($documentCategory->toArray(), 'Document Category retrieved successfully');
    }

    /**
     * Update the specified DocumentCategory in storage.
     * PUT/PATCH /documentCategories/{id}
     *
     * @param  int $id
     * @param UpdateDocumentCategoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var DocumentCategory $documentCategory */
        $documentCategory = $this->documentCategoryRepository->findWithoutFail($id);

        if (empty($documentCategory)) {
            return $this->sendError('Document Category not found');
        }

        $documentCategory = $this->documentCategoryRepository->update($input, $id);

        return $this->sendResponse($documentCategory->toArray(), 'DocumentCategory updated successfully');
    }

    /**
     * Remove the specified DocumentCategory from storage.
     * DELETE /documentCategories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DocumentCategory $documentCategory */
        $documentCategory = $this->documentCategoryRepository->findWithoutFail($id);

        if (empty($documentCategory)) {
            return $this->sendError('Document Category not found');
        }

        $documentCategory->delete();

        return $this->sendResponse($id, 'Document Category deleted successfully');
    }
}
