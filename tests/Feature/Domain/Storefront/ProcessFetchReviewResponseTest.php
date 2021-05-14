<?php

namespace EolabsIo\YotpoApi\Tests\Feature\Domain\Storefront;

use EolabsIo\YotpoApi\Tests\TestCase;
use EolabsIo\YotpoApi\Support\Facades\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Review as ReviewModel;
use EolabsIo\YotpoApi\Domain\Storefront\Jobs\ProcessFetchReviewResponse;

class ProcessFetchReviewResponseTest extends TestCase
{
    use RefreshDatabase;

    public $results;

    protected function setUp(): void
    {
        parent::setUp();

        Review::fake();

        $id = 12345;

        $this->results = Review::withProductId($id)->fetch();

        (new ProcessFetchReviewResponse($this->results))->handle();
    }

    /** @test */
    public function it_can_process_list_review_response()
    {
        $review = ReviewModel::with([
                'product',
                'user',
                'comment',
                'imagesData',
            ])->first();

        $this->assertEquals(110, $review->id);
        $this->assertEquals(5, $review->score);
        $this->assertEquals(1, $review->votes_up);
        $this->assertEquals(0, $review->votes_down);
        $this->assertEquals("Great mug", $review->content);
        $this->assertEquals("Perfect", $review->title);
        $this->assertEquals(0.852, $review->sentiment);
        $this->assertEquals("Thu Jun 16 2016 12:16:05 GMT+0000", $review->created_at->toString());
        $this->assertTrue($review->verified_buyer);
        $this->assertNull($review->source_review_id);
        $this->assertNull($review->custom_fields);
        $this->assertFalse($review->deleted);
        $this->assertEquals(5, $review->score);
        $this->assertEquals(1, $review->votes_up);
        $this->assertEquals(0, $review->votes_down);
        $this->assertEquals("Great mug", $review->content);
        $this->assertEquals("Perfect", $review->title);
        $this->assertEquals(0.852, $review->sentiment);
        $this->assertEquals("Thu Jun 16 2016 12:16:05 GMT+0000", $review->created_at->toString());

        // Relationships
        $this->assertProduct($review);
        $this->assertUser($review);
        $this->assertComment($review);
        $this->assertImagesData($review);
    }

    /** @test */
    public function it_can_process_same_order_without_duplication_response()
    {
        $this->assertOrderDataBaseState();

        // Same repsonse as before processed a second time
        (new ProcessFetchReviewResponse($this->results))->handle();

        $this->assertOrderDataBaseState();
    }

    public function assertOrderDataBaseState()
    {
        $this->assertDatabaseCount('comments', 1);
        $this->assertDatabaseCount('images_data', 2);
        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseCount('reviews', 1);
        $this->assertDatabaseCount('social_links', 4);
        $this->assertDatabaseCount('users', 1);
    }

    public function assertProduct($review)
    {
        $product = $review->product;

        $this->assertEquals(13, $product->id);
        $this->assertEquals(412790437, $product->domain_key);
        $this->assertEquals('Yotpo Mug', $product->name);
        $this->assertEquals("https://yotpo.com/go/mjbdNtvQ", $product->embedded_widget_link);
        $this->assertEquals("https://yotpo.com/go/45Vp7nuj", $product->testimonials_product_link);
        $this->assertEquals("https://yotpo.com/go/lnhRGFr0", $product->product_link);

        $this->assertDatabaseCount('social_links', 4);
    }

    public function assertUser($review)
    {
        $user = $review->user;

        $this->assertEquals(18, $user->user_id);
        $this->assertEquals('John Doe', $user->display_name);
        $this->assertEquals('https://ddcfq0gxiontw.cloudfront.net/images/anonymous_user.png', $user->social_image);
        $this->assertEquals('User', $user->user_type);
    }

    public function assertComment($review)
    {
        $comment = $review->comment;

        $this->assertEquals(1336007, $comment->id);

        $this->assertEquals("Thanks for your review", $comment->content);
        $this->assertEquals("Wed May 03 2017 07:19:25 GMT+0000", $comment->created_at->toString());
        $this->assertNull($comment->comments_avatar);
    }

    public function assertImagesData($review)
    {
        $imagesData = $review->imagesData->first();

        $this->assertEquals(13, $imagesData->id);
        $this->assertEquals(110, $imagesData->review_id);

        $this->assertEquals('http://s3.amazonaws.com/yotpo-images-test/Review/29/13/square.jpeg?1457513657', $imagesData->thumb_url);
        $this->assertEquals('http://s3.amazonaws.com/yotpo-images-test/Review/29/13/original.jpeg?1457513657', $imagesData->original_url);
    }
}
