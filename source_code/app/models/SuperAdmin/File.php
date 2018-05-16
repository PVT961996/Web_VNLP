<?php

namespace App\Models\Superadmin;

use Eloquent as Model;
use App\User;
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
        'name',
        'summary',
        'content',
        'description',
        'document_id',
        'view',
        'file',
        'link_download',
        'user_id',
        'point',
        'status',
        'like',
        'dislike',
        'neutral'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'summary' => 'string',
        'content' => 'string',
        'description' => 'string',
        'document_id' => 'integer',
        'user_id' => 'integer',
        'view' => 'integer',
        'file' => 'string',
        'link_download' => 'string',
        'like' => 'integer',
        'dislike' => 'integer',
        'neutral' => 'integer',
        'point' => 'float',
        'status' => 'integer',
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

    public function documents()
    {
        return $this->belongsToMany('App\Models\SuperAdmin\Document', 'document_files', 'file_id', 'document_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function fileUser()
    {
        return $this->belongsToMany(User::class, 'file_users', 'file_id', 'user_id');
    }
}
