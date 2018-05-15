<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Requests\Superadmin\CreateFileUserRequest;
use App\Http\Requests\Superadmin\UpdateFileUserRequest;
use App\Repositories\Superadmin\FileRepository;
use App\Repositories\Superadmin\FileUserRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SuperAdmin\UserRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Auth;

class FileUserController extends AppBaseController
{
    /** @var  FileUserRepository */
    private $fileUserRepository;
    private $userRepository;
    private $fileRepository;

    public function __construct(FileUserRepository $fileUserRepo,UserRepository $userRepo, FileRepository $fileRepo)
    {
        $this->fileUserRepository = $fileUserRepo;
        $this->userRepository = $userRepo;
        $this->fileRepository = $fileRepo;
    }

    /**
     * Display a listing of the FileUser.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fileUserRepository->pushCriteria(new RequestCriteria($request));
        $fileUsers = $this->fileUserRepository->findByField('user_id','=', Auth::user()->id,['*'], true, 10);

        return view('superadmin.file_users.index')
            ->with('fileUsers', $fileUsers);
    }

    /**
     * Show the form for creating a new FileUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('superadmin.file_users.create');
    }

    /**
     * Store a newly created FileUser in storage.
     *
     * @param CreateFileUserRequest $request
     *
     * @return Response
     */
    public function store(CreateFileUserRequest $request)
    {
        $input = $request->all();

        $fileUser = $this->fileUserRepository->create($input);

        Flash::success('File User saved successfully.');

        return redirect(route('superadmin.fileUsers.index'));
    }

    /**
     * Display the specified FileUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fileUser = $this->fileUserRepository->findWithoutFail($id);

        if (empty($fileUser)) {
            Flash::error('File User not found');

            return redirect(route('superadmin.fileUsers.index'));
        }

        return view('superadmin.file_users.show')->with('fileUser', $fileUser);
    }

    /**
     * Show the form for editing the specified FileUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fileUser = $this->fileUserRepository->findWithoutFail($id);
        $users = $this->userRepository->getAllUser();
        $selectedUser= $fileUser->user_id;
        $selectedFile= $fileUser->file_id;
        $nameSelectedFile = $fileUser->file->name;

        if (empty($fileUser)) {
            Flash::error('File User not found');

            return redirect(route('superadmin.fileUsers.index'));
        }

        return view('superadmin.file_users.edit', compact('fileUser','users','selectedUser','nameSelectedFile','selectedFile'));
    }

    /**
     * Update the specified FileUser in storage.
     *
     * @param  int              $id
     * @param UpdateFileUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFileUserRequest $request)
    {
        $fileUser = $this->fileUserRepository->findWithoutFail($id);

        if (empty($fileUser)) {
            Flash::error('File User not found');

            return redirect(route('superadmin.fileUsers.index'));
        }

        $fileUser = $this->fileUserRepository->update($request->all(), $id);

        Flash::success('File User updated successfully.');

        return redirect(route('superadmin.fileUsers.index'));
    }

    /**
     * Remove the specified FileUser from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fileUser = $this->fileUserRepository->findWithoutFail($id);

        if (empty($fileUser)) {
            Flash::error('File User not found');

            return redirect(route('superadmin.fileUsers.index'));
        }

        $this->fileUserRepository->delete($id);

        Flash::success('File User deleted successfully.');

        return redirect(route('superadmin.fileUsers.index'));
    }
}
