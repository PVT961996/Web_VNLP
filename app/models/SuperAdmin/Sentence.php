<?php

namespace App\Models\Superadmin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sentence
 * @package App\Models\Superadmin
 * @version April 2, 2018, 3:17 am UTC
 *
 * @property \App\Models\Superadmin\File file
 * @property string content
 * @property integer file_id
 */
class Sentence extends Model
{
//    use SoftDeletes;

    public $table = 'sentences';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'content',
        'file_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'string',
        'file_id' => 'integer'
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
}
