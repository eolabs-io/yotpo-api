<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Listeners;

use EolabsIo\YotpoApi\Domain\Storefront\Events\FetchReview;
use EolabsIo\YotpoApi\Domain\Storefront\Jobs\PerformFetchReview;

class FetchReviewListener
{
    public function handle(FetchReview $event)
    {
        $review = $event->review;
        PerformFetchReview::dispatch($review)->onQueue('yotpo-api');
    }
}
