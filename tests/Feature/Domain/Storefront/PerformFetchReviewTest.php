<?php

namespace EolabsIo\YotpoApi\Tests\Feature\Domain\Storefront;

use EolabsIo\YotpoApi\Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\YotpoApi\Support\Facades\Review;
use EolabsIo\YotpoApi\Domain\Storefront\Jobs\PerformFetchReview;
use EolabsIo\YotpoApi\Domain\Storefront\Jobs\ProcessFetchReviewResponse;

class PerformFetchReviewTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_calls_the_correct_job()
    {
        Review::fake();

        $id = 12345;

        PerformFetchReview::dispatch(Review::withProductId($id));

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchReview::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessFetchReviewResponse::class, function ($job) {
            return data_get($job->results, 'response.reviews.0.id') === 110;
        });
    }
}
