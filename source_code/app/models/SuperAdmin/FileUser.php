<?php

namespace App\Models\Superadmin;

use Eloquent as Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FileUser
 * @package App\Models\Superadmin
 * @version May 9, 2018, 10:09 am UTC
 *
 * @property \App\Models\Superadmin\User user
 * @property \App\Models\Superadmin\File file
 * @property integer user_id
 * @property integer file_id
 * @property string phone
 * @property string email
 * @property string description
 */
class FileUser extends Model
{
//    use SoftDeletes;

    public $table = 'file_users';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'file_id',
        'phone',
        'email',
        'description',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'file_id' => 'integer',
        'phone' => 'string',
        'email' => 'string',
        'description' => 'string',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function file()
    {
        return $this->belongsTo(\App\Models\Superadmin\File::class, 'file_id', 'id');
    }
}
