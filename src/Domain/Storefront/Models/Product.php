<?php
namespace EolabsIo\YotpoApi\Domain\Storefront\Models;

use EolabsIo\YotpoApi\Domain\Shared\Models\YotpoModel;
use EolabsIo\YotpoApi\Database\Factories\ProductFactory;
use EolabsIo\YotpoApi\Domain\Storefront\Models\SocialLink;

class Product extends YotpoModel
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'domain_key',
        'name',
        'embedded_widget_link',
        'testimonials_product_link',
        'product_link',
    ];

    public function socialLinks()
    {
        return $this->belongsToMany(SocialLink::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return ProductFactory::new();
    }
}
