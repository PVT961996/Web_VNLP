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

    public function search($condition, $categoryId = null)
    {
        $this->applyConditions($condition);
        if (!empty($categoryId)) {
            $files = $this->model->with('documents')->join('document_files', function ($join) {
                $join->on('files.id', '=', 'document_files.file_id');
            })->where('document_files.document_id', $categoryId)->whereNull('document_files.deleted_at')->paginate(10, ['files.*']);
        } else {
            $files = $this->model->with('documents');
        }
        $this->resetModel();
        return $files;
    }

    public function getDocumentsByCategorySlug($categorySlug = null, $name = null)
    {
        $documents = null;
        if (empty($categorySlug)) {
            $documents = $this->model->where('name', 'LIKE', '%' . $name . '%')->whereHas('categories')->paginate(16);
        } else {
            $documents = $this->model->with('categories')->join('document_categories', function ($join) {
                $join->on('documents.id', '=', 'document_categories.document_id');
            })->join('category_docs', function ($join) {
                $join->on('category_docs.id', '=', 'document_categories.category_id');
            })->where(function ($q) use ($name) {
                $q->where('documents.name', 'LIKE', '%' . $name . '%');
            })->where('category_docs.slug', $categorySlug)->whereNull('document_categories.deleted_at')->paginate(16, ['documents.*']);
        }

        $this->resetModel();
        return $documents;
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
