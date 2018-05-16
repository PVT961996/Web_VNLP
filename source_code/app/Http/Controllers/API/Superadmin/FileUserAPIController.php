<?php

namespace App\Http\Controllers\API\Superadmin;

use App\Http\Requests\API\Superadmin\CreateFileUserAPIRequest;
use App\Http\Requests\API\Superadmin\UpdateFileUserAPIRequest;
use App\Models\Superadmin\FileUser;
use App\Repositories\Superadmin\FileUserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;

//use Response;


/**
 * Class FileUserController
 * @package App\Http\Controllers\API\Superadmin
 */
class FileUserAPIController extends AppBaseController
{
    /** @var  FileUserRepository */
    private $fileUserRepository;

    public function __construct(FileUserRepository $fileUserRepo)
    {
        $this->fileUserRepository = $fileUserRepo;
    }

    /**
     * Display a listing of the FileUser.
     * GET|HEAD /fileUsers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fileUserRepository->pushCriteria(new RequestCriteria($request));
        $this->fileUserRepository->pushCriteria(new LimitOffsetCriteria($request));
        $fileUsers = $this->fileUserRepository->all();

        return $this->sendResponse($fileUsers->toArray(), 'File Users retrieved successfully');
    }

    /**
     * Store a newly created FileUser in storage.
     * POST /fileUsers
     *
     * @param CreateFileUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFileUserAPIRequest $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $result = [];
            if (empty($request->email) || empty($request->phone)) {
                $result = array(
                    'error' => 'Email hoặc số điện thoại không được để trống'
                );
            }
            else{
                $input['status'] = 0;
                $fileUsers = $this->fileUserRepository->create($input);
            }
            return Response::json($result);
//        return redirect('/');
//            return $this->sendResponse($fileUsers->toArray(), 'File User saved successfully');
//            }
        }
    }

    /**
     * Display the specified FileUser.
     * GET|HEAD /fileUsers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var FileUser $fileUser */
        $fileUser = $this->fileUserRepository->findWithoutFail($id);

        if (empty($fileUser)) {
            return $this->sendError('File User not found');
        }

        return $this->sendResponse($fileUser->toArray(), 'File User retrieved successfully');
    }

    /**
     * Update the specified FileUser in storage.
     * PUT/PATCH /fileUsers/{id}
     *
     * @param  int $id
     * @param UpdateFileUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFileUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var FileUser $fileUser */
        $fileUser = $this->fileUserRepository->findWithoutFail($id);

        if (empty($fileUser)) {
            return $this->sendError('File User not found');
        }

        $fileUser = $this->fileUserRepository->update($input, $id);

        return $this->sendResponse($fileUser->toArray(), 'FileUser updated successfully');
    }

    /**
     * Remove the specified FileUser from storage.
     * DELETE /fileUsers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var FileUser $fileUser */
        $fileUser = $this->fileUserRepository->findWithoutFail($id);

        if (empty($fileUser)) {
            return $this->sendError('File User not found');
        }

        $fileUser->delete();

        return $this->sendResponse($id, 'File User deleted successfully');
    }
}
