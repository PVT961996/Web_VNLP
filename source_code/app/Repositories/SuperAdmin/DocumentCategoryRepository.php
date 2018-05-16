<?php

namespace App\Repositories\Superadmin;

use App\Models\Superadmin\DocumentCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DocumentCategoryRepository
 * @package App\Repositories\Superadmin
 * @version March 15, 2018, 4:59 am UTC
 *
 * @method DocumentCategory findWithoutFail($id, $columns = ['*'])
 * @method DocumentCategory find($id, $columns = ['*'])
 * @method DocumentCategory first($columns = ['*'])
*/
class DocumentCategoryRepository extends BGBaseRepository
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
        return DocumentCategory::class;
    }

    public function model()
    {
        return DocumentCategory::class;
    }
}
