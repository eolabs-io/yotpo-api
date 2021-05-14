<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Review;

class PersistedReviewEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\YotpoApi\Domain\Storefront\Models\Review */
    public $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }
}
