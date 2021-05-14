<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\YotpoApi\Domain\Storefront\Review;
use EolabsIo\YotpoApi\Domain\Storefront\Events\FetchReview;
use EolabsIo\YotpoApi\Domain\Storefront\Jobs\ProcessFetchReviewResponse;

class PerformFetchReview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var EolabsIo\YotpoApi\Domain\Storefront\Review */
    public $review;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->review->fetch();

            ProcessFetchReviewResponse::dispatch($results);
            FetchReview::dispatchIf($this->review->hasNextPage(), $this->review);
        } catch (RequestException $exception) {
            // $delay = 30;
            // $this->handleRequestException($exception, $delay);
        }
    }
}
