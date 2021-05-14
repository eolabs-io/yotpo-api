<?php

namespace EolabsIo\YotpoApi\Tests\Unit\Domain\Storefront;

use EolabsIo\YotpoApi\Tests\Unit\BaseModelTest;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Review;
use EolabsIo\YotpoApi\Domain\Storefront\Models\ImagesData;

class ReviewTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Review::class;
    }

    /** @test */
    public function it_has_imagesDatas_relationship()
    {
        $review = Review::factory()->create();
        $imagesData = ImagesData::factory()->times(3)->create(['review_id' => $review->id]);

        $this->assertDatabaseCount('reviews', 1);
        $this->assertDatabaseCount('images_data', 3);
        $this->assertArraysEqual($imagesData->toArray(), $review->imagesData->toArray());
    }
}
