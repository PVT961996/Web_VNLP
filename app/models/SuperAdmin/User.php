<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 */
class User extends Model
{
//    use SoftDeletes;

    public $table = 'users';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name', 'email', 'password', 'group_id','avatar','age','sex','phone','address', 'confirmed'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'confirmed' => 'not_in:0',
        'phone' => array('required', 'regex:/^(01)[0-9]{9}$|^(09)[0-9]{8}$|^(\+841)[0-9]{9}$|^(\+849)[0-9]{8}$/', 'unique:users'),
        'password'=>'required|min:6',
        'group_id'=>'required|not_in:0',
        'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'age'=>'max:100',
    ];

    public static $rules_update = [
        'name' => 'required|max:255',
        'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'age'=>'nullable|numeric|min:1|max:200',
    ];

    public static function attributes() {
        return  [
            'name' => __('messages.user_name'),
            'phone' => __('messages.user_phone'),
            'email' => __('messages.user_email'),
            'confirmed' => __('messages.user_actived'),
            'password' => __('messages.user_password'),
            'group_id' => __('messages.user_group'),
            'age' => __('messages.user_age'),
            'sex' => __('messages.user_sex'),
            'avatar' => __('messages.user_avatar'),
        ];
    }
}
