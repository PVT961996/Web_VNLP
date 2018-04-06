<?php

namespace App\Models\Superadmin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class File
 * @package App\Models\Superadmin
 * @version April 2, 2018, 3:12 am UTC
 *
 * @property \App\Models\Superadmin\Document document
 * @property string summary
 * @property string content
 * @property string description
 * @property integer document_id
 */
class File extends Model
{
//    use SoftDeletes;

    public $table = 'files';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'summary',
        'content',
        'description',
        'document_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'summary' => 'string',
        'content' => 'string',
        'description' => 'string',
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
    public function document()
    {
        return $this->belongsTo(\App\Models\Superadmin\Document::class, 'document_id', 'id');
    }
}
