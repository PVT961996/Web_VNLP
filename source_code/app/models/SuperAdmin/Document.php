<?php

namespace App\Models\SuperAdmin;

use Eloquent as Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Document
 * @package App\Models\Superadmin
 * @version March 15, 2018, 4:48 am UTC
 *
 * @property \App\Models\Superadmin\User user
 * @property string name
 * @property string short_description
 * @property string description
 * @property string slug
 * @property integer comment_counts
 * @property integer view_counts
 * @property string image
 * @property string file
 * @property string link_download
 * @property string source
 * @property integer user_id
 */
class Document extends Model
{
//    use SoftDeletes;

    public $table = 'documents';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'short_description',
        'description',
        'slug',
        'comment_counts',
        'view_counts',
        'image',
        'file',
        'link_download',
        'type',
        'source',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'short_description' => 'string',
        'description' => 'string',
        'slug' => 'string',
        'comment_counts' => 'integer',
        'view_counts' => 'integer',
        'image' => 'string',
        'file' => 'string',
        'link_download' => 'string',
        'type' => 'integer',
        'source' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

//    public function offerPosts()
//    {
//        return $this->hasMany(\App\Models\SuperAdmin\OfferPost::class);
//    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\SuperAdmin\CategoryDoc', 'document_categories', 'document_id', 'category_id');
    }

//    public function parent() {
//        return $this->belongsTo('App\Models\SuperAdmin\Document', 'parent_id');
//    }
//
//    public function children($columns = ['*'])
//    {
//        return $this->hasMany('App\Models\SuperAdmin\Document', 'parent_id')->orderBy('orderSort','asc')->orderBy('updated_at','desc')->get($columns);
//    }

    public function files()
    {
        return $this->belongsToMany('App\Models\SuperAdmin\File', 'document_files', 'document_id', 'file_id');
    }
}
