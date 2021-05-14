<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Events;

use EolabsIo\YotpoApi\Domain\Storefront\Models\Product;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PersistedProductEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\YotpoApi\Domain\Storefront\Models\Product */
    public $review;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
