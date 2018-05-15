<?php

namespace App\Repositories\SuperAdmin;

use App\Models\Admin\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories\Admin
 * @version February 16, 2018, 2:06 pm UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BGBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'confirmed',
        'group_id',
        'avatar',
        'age',
        'phone',
        'address',
        'sex'
    ];


    public function BGModel()
    {
        return User::class;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function search($condition)
    {
        $this->applyConditions($condition);
        return $this->orderBy('updated_at', 'DESC')->paginate(5);
    }

    public function getAllUser() {
        $userList = $this->model->get();

        $users = array();
        $users[0] = '-- '.__('messages.select_user').' --';
        foreach ($userList as $user) {
            $users[$user->id] = $user->name;
        }

        $this->resetModel();

        return $users;
    }
}
