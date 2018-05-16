<?php

namespace App\Repositories\Superadmin;

use App\Models\Superadmin\Sentence;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SentenceRepository
 * @package App\Repositories\Superadmin
 * @version April 2, 2018, 3:17 am UTC
 *
 * @method Sentence findWithoutFail($id, $columns = ['*'])
 * @method Sentence find($id, $columns = ['*'])
 * @method Sentence first($columns = ['*'])
*/
class SentenceRepository extends BGBaseRepository
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
        return Sentence::class;
    }

    public function model()
    {
        return Sentence::class;
    }

    public function search($condition)
    {
        $this->applyConditions($condition);
        return $this->model->paginate(10);
    }

}
