<?php

namespace EolabsIo\YotpoApi\Tests\Unit\Domain\Storefront;

use EolabsIo\YotpoApi\Tests\Unit\BaseModelTest;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Product;
use EolabsIo\YotpoApi\Domain\Storefront\Models\SocialLink;

class ProductTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Product::class;
    }

    /** @test */
    public function it_has_socialLinks_relationship()
    {
        $socialLinks = SocialLink::factory()->times(3)->create();
        $product = Product::factory()->create();

        $product->socialLinks()->attach($socialLinks);

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseCount('social_links', 3);
        $this->assertArraysEqual($socialLinks->toArray(), $product->socialLinks->toArray());
    }
}
