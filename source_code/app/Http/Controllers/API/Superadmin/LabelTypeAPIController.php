<?php

namespace App\Http\Controllers\API\Superadmin;

use App\Http\Requests\API\Superadmin\CreateLabelTypeAPIRequest;
use App\Http\Requests\API\Superadmin\UpdateLabelTypeAPIRequest;
use App\Models\Superadmin\LabelType;
use App\Repositories\Superadmin\LabelTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LabelTypeController
 * @package App\Http\Controllers\API\Superadmin
 */

class LabelTypeAPIController extends AppBaseController
{
    /** @var  LabelTypeRepository */
    private $labelTypeRepository;

    public function __construct(LabelTypeRepository $labelTypeRepo)
    {
        $this->labelTypeRepository = $labelTypeRepo;
    }

    /**
     * Display a listing of the LabelType.
     * GET|HEAD /labelTypes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->labelTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->labelTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $labelTypes = $this->labelTypeRepository->all();

        return $this->sendResponse($labelTypes->toArray(), 'Label Types retrieved successfully');
    }

    /**
     * Store a newly created LabelType in storage.
     * POST /labelTypes
     *
     * @param CreateLabelTypeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLabelTypeAPIRequest $request)
    {
        $input = $request->all();

        $labelTypes = $this->labelTypeRepository->create($input);

        return $this->sendResponse($labelTypes->toArray(), 'Label Type saved successfully');
    }

    /**
     * Display the specified LabelType.
     * GET|HEAD /labelTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var LabelType $labelType */
        $labelType = $this->labelTypeRepository->findWithoutFail($id);

        if (empty($labelType)) {
            return $this->sendError('Label Type not found');
        }

        return $this->sendResponse($labelType->toArray(), 'Label Type retrieved successfully');
    }

    /**
     * Update the specified LabelType in storage.
     * PUT/PATCH /labelTypes/{id}
     *
     * @param  int $id
     * @param UpdateLabelTypeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLabelTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var LabelType $labelType */
        $labelType = $this->labelTypeRepository->findWithoutFail($id);

        if (empty($labelType)) {
            return $this->sendError('Label Type not found');
        }

        $labelType = $this->labelTypeRepository->update($input, $id);

        return $this->sendResponse($labelType->toArray(), 'LabelType updated successfully');
    }

    /**
     * Remove the specified LabelType from storage.
     * DELETE /labelTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var LabelType $labelType */
        $labelType = $this->labelTypeRepository->findWithoutFail($id);

        if (empty($labelType)) {
            return $this->sendError('Label Type not found');
        }

        $labelType->delete();

        return $this->sendResponse($id, 'Label Type deleted successfully');
    }
}
