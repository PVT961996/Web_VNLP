<?php

namespace App\Models\Superadmin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LabelType
 * @package App\Models\Superadmin
 * @version April 30, 2018, 9:28 am UTC
 *
 * @property string name
 * @property string description
 * @property integer type
 */
class LabelType extends Model
{
//    use SoftDeletes;

    public $table = 'label_types';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'type' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
