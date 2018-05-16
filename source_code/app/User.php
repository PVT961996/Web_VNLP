<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'group_id', 'avatar', 'age', 'sex', 'phone', 'address', 'confirmation_code', 'confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function whereConfirmationCode($confirmationCode)
    {
        return User::where(['confirmation_code' => $confirmationCode])->first();
    }


    public static function attributes()
    {
        return ['password' => 'Mật khẩu',
            'email' => 'Email',
            'name' => 'Tên'
        ];
    }
}
