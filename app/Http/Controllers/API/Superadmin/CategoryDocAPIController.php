<?php

namespace App\Http\Controllers\API\Superadmin;

use App\Http\Requests\API\Superadmin\CreateCategoryDocAPIRequest;
use App\Http\Requests\API\Superadmin\UpdateCategoryDocAPIRequest;
use App\Models\Superadmin\CategoryDoc;
use App\Repositories\Superadmin\CategoryDocRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CategoryDocController
 * @package App\Http\Controllers\API\Superadmin
 */

class CategoryDocAPIController extends AppBaseController
{
    /** @var  CategoryDocRepository */
    private $categoryDocRepository;

    public function __construct(CategoryDocRepository $categoryDocRepo)
    {
        $this->categoryDocRepository = $categoryDocRepo;
    }

    /**
     * Display a listing of the CategoryDoc.
     * GET|HEAD /categoryDocs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categoryDocRepository->pushCriteria(new RequestCriteria($request));
        $this->categoryDocRepository->pushCriteria(new LimitOffsetCriteria($request));
        $categoryDocs = $this->categoryDocRepository->all();

        return $this->sendResponse($categoryDocs->toArray(), 'Category Docs retrieved successfully');
    }

    /**
     * Store a newly created CategoryDoc in storage.
     * POST /categoryDocs
     *
     * @param CreateCategoryDocAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryDocAPIRequest $request)
    {
        $input = $request->all();

        $categoryDocs = $this->categoryDocRepository->create($input);

        return $this->sendResponse($categoryDocs->toArray(), 'Category Doc saved successfully');
    }

    /**
     * Display the specified CategoryDoc.
     * GET|HEAD /categoryDocs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CategoryDoc $categoryDoc */
        $categoryDoc = $this->categoryDocRepository->findWithoutFail($id);

        if (empty($categoryDoc)) {
            return $this->sendError('Category Doc not found');
        }

        return $this->sendResponse($categoryDoc->toArray(), 'Category Doc retrieved successfully');
    }

    /**
     * Update the specified CategoryDoc in storage.
     * PUT/PATCH /categoryDocs/{id}
     *
     * @param  int $id
     * @param UpdateCategoryDocAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryDocAPIRequest $request)
    {
        $input = $request->all();

        /** @var CategoryDoc $categoryDoc */
        $categoryDoc = $this->categoryDocRepository->findWithoutFail($id);

        if (empty($categoryDoc)) {
            return $this->sendError('Category Doc not found');
        }

        $categoryDoc = $this->categoryDocRepository->update($input, $id);

        return $this->sendResponse($categoryDoc->toArray(), 'CategoryDoc updated successfully');
    }

    /**
     * Remove the specified CategoryDoc from storage.
     * DELETE /categoryDocs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CategoryDoc $categoryDoc */
        $categoryDoc = $this->categoryDocRepository->findWithoutFail($id);

        if (empty($categoryDoc)) {
            return $this->sendError('Category Doc not found');
        }

        $categoryDoc->delete();

        return $this->sendResponse($id, 'Category Doc deleted successfully');
    }
}
