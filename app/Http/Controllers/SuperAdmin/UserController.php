<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Requests\SuperAdmin\CreateUserRequest;
use App\Http\Requests\SuperAdmin\UpdateUserRequest;
use App\Repositories\SuperAdmin\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Hash;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $searchCondition = [];
        if (!empty($search)) {
            if (!empty($search['name'])) {
                array_push($searchCondition, ['name', 'LIKE', '%' . $search['name'] . '%']);
            }
            if (!empty($search['email'])) {
                array_push($searchCondition, ['email', 'LIKE', '%' . $search['email'] . '%']);
            }
            $users = $this->userRepository->search($searchCondition);
        } else
            $users = $this->userRepository->orderBy('updated_at', 'DESC')->paginate(10);
        $totalPages = 1;
        return view('superadmin.users.index')
            ->with('users', $users)->with('totalPages', $totalPages);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('superadmin.users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        if (strpos($request['phone'], '+84') !== false)
            $request['phone'] = str_replace('+84', '0', $request['phone']);
        if (!empty($request->avatar)) {
            $imageName = time() . '.' . $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('uploads'), $imageName);
            $request->avatar = $imageName;
            $input['avatar'] = '/uploads/' . $imageName;
        } else {
            $input['avatar'] = '/uploads/default-avatar.png';
        }

        $password = Hash::make($request->password);
        $input = $request->all();
        $input['password'] = $password;
        $this->userRepository->create($input);

        Flash::success(__('messages.created'));

        return redirect(route('superadmin.users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('messages.no-items');

            return redirect(route('superadmin.users.index'));
        }

        return view('superadmin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
        $user['password'] = '';
        $edit = true;
        if (empty($user)) {
            Flash::error('messages.no-items');

            return redirect(route('superadmin.users.index'));
        }

        return view('superadmin.users.edit')->with('user', $user)->with('edit', $edit);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        if (strpos($request['phone'], '+84') !== false)
            $request['phone'] = str_replace('+84', '0', $request['phone']);
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('messages.no-items');

            return redirect(route('superadmin.users.index'));
        }

        if (!empty($request->password)) {
            $input = $request->all();
            $password = Hash::make($request->password);
            $input['password'] = $password;
        } else $input = $request->only(['name', 'sex', 'age', 'address', 'confirmed']);

        if (!empty($request->avatar)) {
            $imageName = time() . '.' . $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('uploads'), $imageName);
            $request->avatar = $imageName;
            $input['avatar'] = '/uploads/' . $imageName;
        }
        $user = $this->userRepository->update($input, $id);

        Flash::success(__('messages.updated'));

        return redirect(route('superadmin.users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        if ($id == 'MULTI') {
            if (empty($request->ids)) Flash::error(__('messages.not-found'));
            else {
                foreach ($request->ids as $id) {
                    $users = $this->userRepository->findWithoutFail($id);

                    if (empty($users)) {
                        Flash::error(__('messages.not-found'));

                        return redirect(route('superadmin.users.index'));
                    }
                    $this->userRepository->delete($id);
                }

                Flash::success(__('messages.deleted'));
            }
        } else {
            $user = $this->userRepository->findWithoutFail($id);

            if (empty($user)) {
                Flash::error('messages.no-items');

                return redirect(route('superadmin.users.index'));
            }
            $this->userRepository->delete($id);

            Flash::success(__('messages.deleted'));
        }
        return redirect(route('superadmin.users.index'));
    }
}
