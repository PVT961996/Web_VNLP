<?php

namespace App\Models\SuperAdmin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OfferPost
 * @package App\Models
 * @version March 29, 2018, 7:41 am UTC
 *
 * @property \App\Models\Document document
 * @property string short_description
 * @property string description
 * @property integer offer_counts
 * @property integer view_counts
 * @property string file
 * @property string link_download
 * @property string source
 * @property integer post_id
 */
class OfferPost extends Model
{
//    use SoftDeletes;

    public $table = 'offer_posts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'content',
        'file_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'string',
        'file_id' => 'integer',
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
    public function file()
    {
        return $this->belongsTo(\App\Models\SuperAdmin\File::class, 'file_id', 'id');
    }
}
