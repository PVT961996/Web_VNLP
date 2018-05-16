<?php

namespace App\Models\Superadmin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocumentCategory
 * @package App\Models\Superadmin
 * @version March 15, 2018, 4:59 am UTC
 *
 * @property \App\Models\Superadmin\CategoryDoc categoryDoc
 * @property \App\Models\Superadmin\Document document
 * @property integer category_id
 * @property integer document_id
 */
class DocumentCategory extends Model
{
//    use SoftDeletes;

    public $table = 'document_categories';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'category_id',
        'document_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'integer',
        'document_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function categoryDoc()
    {
        return $this->belongsTo(\App\Models\Superadmin\CategoryDoc::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function document()
    {
        return $this->belongsTo(\App\Models\Superadmin\Document::class, 'document_id', 'id');
    }
}
