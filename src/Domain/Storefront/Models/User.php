<?php
namespace EolabsIo\YotpoApi\Domain\Storefront\Models;

use EolabsIo\YotpoApi\Domain\Shared\Models\YotpoModel;
use EolabsIo\YotpoApi\Database\Factories\UserFactory;

class User extends YotpoModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_social_connected' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'display_name',
        'social_image',
        'user_type',
        'is_social_connected',
    ];

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return UserFactory::new();
    }
}
