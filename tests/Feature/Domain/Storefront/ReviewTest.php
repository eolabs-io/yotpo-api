<?php

namespace EolabsIo\YotpoApi\Tests\Feature\Domain\Storefront;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use EolabsIo\YotpoApi\Tests\TestCase;
use EolabsIo\YotpoApi\Support\Facades\Review;

class ReviewTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_sends_the_correct_request_for_review_query()
    {
        Review::fake();

        $id = '1234567';

        Review::withProductId($id)
            ->fetch();

        Http::assertSent(function ($request) use ($id) {
            return $request->hasHeader('Content-Type', 'application/json') &&
                   $request->url() == "https://api.yotpo.com/v1/widget/yotpoApi-app-key/products/{$id}/reviews.json";
        });
    }

    /** @test */
    public function it_can_get_a_valid_review_response()
    {
        Review::fake();

        $id = '1234567';

        $response = Review::withProductId($id)
            ->fetch();

        $pagination = Arr::get($response, 'response.pagination');
        $product = Arr::get($response, 'response.products.0');
        $review = Arr::get($response, 'response.reviews.0');

        $this->assertPagination($pagination);
        $this->assertProduct($product);
        $this->assertReview($review);
    }

    public function assertPagination($pagination)
    {
        $this->assertEquals(2, Arr::get($pagination, 'page'));
        $this->assertEquals(5, Arr::get($pagination, 'per_page'));
        $this->assertEquals(9, Arr::get($pagination, 'total'));
    }

    public function assertProduct($product)
    {
        $this->assertEquals(13, Arr::get($product, 'id'));
        $this->assertEquals(412790437, Arr::get($product, 'domain_key'));
        $this->assertEquals('Yotpo Mug', Arr::get($product, 'name'));
    }

    public function assertReview($review)
    {
        $this->assertEquals(110, Arr::get($review, 'id'));
        $this->assertEquals(5, Arr::get($review, 'score'));
        $this->assertEquals(1, Arr::get($review, 'votes_up'));
    }
}
