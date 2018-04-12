<?php

namespace App\Repositories\Superadmin;

use App\Models\Superadmin\DocumentFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DocumentFileRepository
 * @package App\Repositories\Superadmin
 * @version April 7, 2018, 2:39 am UTC
 *
 * @method DocumentFile findWithoutFail($id, $columns = ['*'])
 * @method DocumentFile find($id, $columns = ['*'])
 * @method DocumentFile first($columns = ['*'])
*/
class DocumentFileRepository extends BGBaseRepository
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
        return DocumentFile::class;
    }

    public function model()
    {
        return DocumentFile::class;
    }

}
