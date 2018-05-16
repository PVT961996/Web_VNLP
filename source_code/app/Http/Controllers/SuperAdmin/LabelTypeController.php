<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Requests\Superadmin\CreateLabelTypeRequest;
use App\Http\Requests\Superadmin\UpdateLabelTypeRequest;
use App\Repositories\Superadmin\LabelTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class LabelTypeController extends AppBaseController
{
    /** @var  LabelTypeRepository */
    private $labelTypeRepository;

    public function __construct(LabelTypeRepository $labelTypeRepo)
    {
        $this->labelTypeRepository = $labelTypeRepo;
    }

    /**
     * Display a listing of the LabelType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->labelTypeRepository->pushCriteria(new RequestCriteria($request));
        $search = $request->search;
        $searchCondition = [];
        if (!empty($search)) {
            if (!empty($search['name'])) {
                array_push($searchCondition, ['name', 'LIKE', '%' . $search['name'] . '%']);
            }
            if (!empty($search['type']) && $search['type'] != 0) {
                array_push($searchCondition, ['type', '=', $search['type']]);
            }
            $labelTypes = $this->labelTypeRepository->search($searchCondition);
        } else {
            $labelTypes = $this->labelTypeRepository->orderBy('type')->paginate(15);
        }
        return view('superadmin.label_types.index', compact('labelTypes'));
    }

    /**
     * Show the form for creating a new LabelType.
     *
     * @return Response
     */
    public function create()
    {
        return view('superadmin.label_types.create');
    }

    /**
     * Store a newly created LabelType in storage.
     *
     * @param CreateLabelTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateLabelTypeRequest $request)
    {
        $input = $request->all();

        $labelType = $this->labelTypeRepository->create($input);
        Flash::success(__('messages.created'));

        return redirect(route('superadmin.labelTypes.index'));
    }

    /**
     * Display the specified LabelType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $labelType = $this->labelTypeRepository->findWithoutFail($id);

        if (empty($labelType)) {
            Flash::error('Label Type not found');

            return redirect(route('superadmin.labelTypes.index'));
        }

        return view('superadmin.label_types.show')->with('labelType', $labelType);
    }

    /**
     * Show the form for editing the specified LabelType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $labelType = $this->labelTypeRepository->findWithoutFail($id);

        if (empty($labelType)) {
            Flash::error('Label Type not found');

            return redirect(route('superadmin.labelTypes.index'));
        }

        return view('superadmin.label_types.edit')->with('labelType', $labelType);
    }

    /**
     * Update the specified LabelType in storage.
     *
     * @param  int $id
     * @param UpdateLabelTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLabelTypeRequest $request)
    {
        $labelType = $this->labelTypeRepository->findWithoutFail($id);

        if (empty($labelType)) {
            Flash::error('Label Type not found');

            return redirect(route('superadmin.labelTypes.index'));
        }

        $labelType = $this->labelTypeRepository->update($request->all(), $id);

        Flash::success('Label Type updated successfully.');

        return redirect(route('superadmin.labelTypes.index'));
    }

    /**
     * Remove the specified LabelType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $labelType = $this->labelTypeRepository->findWithoutFail($id);

        if (empty($labelType)) {
            Flash::error('Label Type not found');

            return redirect(route('superadmin.labelTypes.index'));
        }

        $this->labelTypeRepository->delete($id);

        Flash::success('Label Type deleted successfully.');

        return redirect(route('superadmin.labelTypes.index'));
    }
}
