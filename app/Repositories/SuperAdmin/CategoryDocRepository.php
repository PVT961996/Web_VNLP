<?php

namespace App\Repositories\Superadmin;

use App\Models\Superadmin\CategoryDoc;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategoryDocRepository
 * @package App\Repositories\Superadmin
 * @version March 15, 2018, 3:55 am UTC
 *
 * @method CategoryDoc findWithoutFail($id, $columns = ['*'])
 * @method CategoryDoc find($id, $columns = ['*'])
 * @method CategoryDoc first($columns = ['*'])
*/
class CategoryDocRepository extends BGBaseRepository
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
        return CategoryDoc::class;
    }

    public function model()
    {
        return CategoryDoc::class;
    }
}
