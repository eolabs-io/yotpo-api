<?php
namespace EolabsIo\YotpoApi\Domain\Storefront\Models;

use EolabsIo\YotpoApi\Domain\Storefront\Models\User;
use EolabsIo\YotpoApi\Domain\Shared\Models\YotpoModel;
use EolabsIo\YotpoApi\Database\Factories\ReviewFactory;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Comment;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Product;

class Review extends YotpoModel
{
    const CREATED_AT = 'model_created_at';
    const UPDATED_AT = 'model_updated_at';

    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'verified_buyer' => 'boolean',
        'deleted' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'score',
        'votes_up',
        'votes_down',
        'content',
        'title',
        'sentiment',
        'created_at',
        'verified_buyer',
        'source_review_id',
        'custom_fields',
        'product_id',
        'deleted',
        'user_id',
        'comment_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id')->withDefault();
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class)->withDefault();
    }

    public function imagesData()
    {
        return $this->hasMany(ImagesData::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return ReviewFactory::new();
    }
}
