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
        'short_description',
        'description',
        'offer_counts',
        'view_counts',
        'file',
        'link_download',
        'source',
        'post_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'short_description' => 'string',
        'description' => 'string',
        'offer_counts' => 'integer',
        'view_counts' => 'integer',
        'file' => 'string',
        'link_download' => 'string',
        'source' => 'string',
        'post_id' => 'integer'
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
    public function document()
    {
        return $this->belongsTo(\App\Models\SuperAdmin\Document::class, 'document_id', 'id');
    }
}
