<?php
namespace EolabsIo\YotpoApi\Domain\Storefront\Models;

use EolabsIo\YotpoApi\Domain\Shared\Models\YotpoModel;
use EolabsIo\YotpoApi\Database\Factories\CommentFactory;

class Comment extends YotpoModel
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
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'content',
        'created_at',
        'comments_avatar',
    ];

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return CommentFactory::new();
    }
}
