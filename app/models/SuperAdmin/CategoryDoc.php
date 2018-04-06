<?php

namespace App\Models\Superadmin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CategoryDoc
 * @package App\Models\Superadmin
 * @version March 15, 2018, 3:55 am UTC
 *
 * @property string name
 * @property string description
 * @property integer orderSort
 * @property integer parent_id
 * @property string slug
 */
class CategoryDoc extends Model
{
//    use SoftDeletes;

    public $table = 'category_docs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'orderSort',
        'parent_id',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'orderSort' => 'integer',
        'parent_id' => 'integer',
        'slug' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function parent() {
        return $this->belongsTo('App\Models\SuperAdmin\CategoryDoc', 'parent_id');
    }

    public function children($columns = ['*'])
    {
        return $this->hasMany('App\Models\SuperAdmin\CategoryDoc', 'parent_id')->orderBy('orderSort','asc')->orderBy('updated_at','desc')->get($columns);
    }

    public function documents()
    {
        return $this->belongsToMany('App\Models\SuperAdmin\Document', 'document_categories', 'category_id', 'document_id');
    }
    
}
