<?php

namespace App\Models\Superadmin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocumentFile
 * @package App\Models\Superadmin
 * @version April 7, 2018, 2:39 am UTC
 *
 * @property \App\Models\Superadmin\File file
 * @property \App\Models\Superadmin\Document document
 * @property integer file_id
 * @property integer document_id
 */
class DocumentFile extends Model
{
//    use SoftDeletes;

    public $table = 'document_files';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'file_id',
        'document_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'file_id' => 'integer',
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
    public function file()
    {
        return $this->belongsTo(\App\Models\Superadmin\File::class, 'file_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function document()
    {
        return $this->belongsTo(\App\Models\Superadmin\Document::class, 'document_id', 'id');
    }
}
