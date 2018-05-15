<?php

namespace App\Repositories\Superadmin;

use App\Models\Superadmin\LabelType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LabelTypeRepository
 * @package App\Repositories\Superadmin
 * @version April 30, 2018, 9:28 am UTC
 *
 * @method LabelType findWithoutFail($id, $columns = ['*'])
 * @method LabelType find($id, $columns = ['*'])
 * @method LabelType first($columns = ['*'])
*/
class LabelTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LabelType::class;
    }

    public function search($condition)
    {
        $this->applyConditions($condition);
        $labelTypes = $this->model->paginate(15);
        $this->resetModel();
        return $labelTypes;
    }
}
