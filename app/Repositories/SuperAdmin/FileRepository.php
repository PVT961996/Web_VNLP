<?php

namespace App\Repositories\Superadmin;

use App\Models\Superadmin\File;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FileRepository
 * @package App\Repositories\Superadmin
 * @version April 2, 2018, 3:12 am UTC
 *
 * @method File findWithoutFail($id, $columns = ['*'])
 * @method File find($id, $columns = ['*'])
 * @method File first($columns = ['*'])
*/
class FileRepository extends BGBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'summary'
    ];

    /**
     * Configure the Model
     **/

    public function BGModel()
    {
        return File::class;
    }

    public function model()
    {
        return File::class;
    }

    public function search($condition)
    {
        $this->applyConditions($condition);
        return $this->model->paginate(10);
    }

    public function getAllFile() {
        $fileList = $this->model->get();

        $files = array();
        $files[0] = '-- '.__('messages.select_file').' --';
        foreach ($fileList as $file) {
            $files[$file->id] = $file->summary;
        }

        $this->resetModel();

        return $files;
    }
}
