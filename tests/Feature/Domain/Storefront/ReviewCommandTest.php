<?php

namespace EolabsIo\YotpoApi\Tests\Feature\Domain\Storefront;

use EolabsIo\YotpoApi\Domain\Storefront\Events\FetchReview;
use EolabsIo\YotpoApi\Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

class ReviewCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    /** @test */
    public function it_can_execute_review_artisan_command()
    {
        $this->artisan('yotpoApi:review')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchReview::class, function ($event) {
            return true;
        });
    }
}
