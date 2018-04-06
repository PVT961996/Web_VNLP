<?php

namespace App\Repositories\Superadmin;

use App\Models\Superadmin\OfferPost;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OfferPostRepository
 * @package App\Repositories
 * @version March 29, 2018, 7:41 am UTC
 *
 * @method OfferPost findWithoutFail($id, $columns = ['*'])
 * @method OfferPost find($id, $columns = ['*'])
 * @method OfferPost first($columns = ['*'])
*/
class OfferPostRepository extends BGBaseRepository
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
        return OfferPost::class;
    }

    public function model()
    {
        return OfferPost::class;
    }

    public function search($where)
    {
        $this->applyConditions($where);
        return $this->orderBy('updated_at', 'DESC')->paginate(10);
    }
}
