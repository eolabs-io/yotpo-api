<?php
namespace EolabsIo\YotpoApi\Domain\Storefront\Models;

use EolabsIo\YotpoApi\Domain\Shared\Models\YotpoModel;
use EolabsIo\YotpoApi\Database\Factories\SocialLinkFactory;

class SocialLink extends YotpoModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'platform',
        'url',
    ];

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return SocialLinkFactory::new();
    }
}
