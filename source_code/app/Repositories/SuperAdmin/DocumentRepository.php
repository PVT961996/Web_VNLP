<?php

namespace App\Repositories\Superadmin;

use App\Models\Superadmin\Document;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DocumentRepository
 * @package App\Repositories\Superadmin
 * @version March 15, 2018, 4:48 am UTC
 *
 * @method Document findWithoutFail($id, $columns = ['*'])
 * @method Document find($id, $columns = ['*'])
 * @method Document first($columns = ['*'])
*/
class DocumentRepository extends BGBaseRepository
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

    public function BGModel()
    {
        return Document::class;
    }

    public function model()
    {
        return Document::class;
    }

    public function getAllDocument() {
        $documentList = $this->model->get();

        $documents = array();
        $documents[0] = '-- '.__('messages.select_document').' --';
        foreach ($documentList as $document) {
            $documents[$document->id] = $document->name;
        }

        $this->resetModel();

        return $documents;
    }

    public function search($condition, $categoryId = null)
    {
        $this->applyConditions($condition);
        if (!empty($categoryId)) {
            $documents = $this->model->with('categories')->join('document_categories', function ($join) {
                $join->on('documents.id', '=', 'document_categories.document_id');
            })->where('document_categories.category_id', $categoryId)->whereNull('document_categories.deleted_at')->paginate(10, ['documents.*']);
        } else {
            $documents = $this->model->with('categories');
        }
        $this->resetModel();
        return $documents;
    }
}
