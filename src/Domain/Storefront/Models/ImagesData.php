<?php
namespace EolabsIo\YotpoApi\Domain\Storefront\Models;

use EolabsIo\YotpoApi\Domain\Shared\Models\YotpoModel;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Review;
use EolabsIo\YotpoApi\Database\Factories\ImagesDataFactory;

class ImagesData extends YotpoModel
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'review_id',
        'thumb_url',
        'original_url',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return ImagesDataFactory::new();
    }
}
