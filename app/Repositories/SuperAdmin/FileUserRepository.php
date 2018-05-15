<?php

namespace App\Repositories\Superadmin;

use App\Models\Superadmin\FileUser;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FileUserRepository
 * @package App\Repositories\Superadmin
 * @version May 9, 2018, 10:09 am UTC
 *
 * @method FileUser findWithoutFail($id, $columns = ['*'])
 * @method FileUser find($id, $columns = ['*'])
 * @method FileUser first($columns = ['*'])
*/
class FileUserRepository extends BGBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/

    public function BGModel()
    {
        return FileUser::class;
    }

    public function model()
    {
        return FileUser::class;
    }
}
