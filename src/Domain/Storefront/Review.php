<?php

namespace EolabsIo\YotpoApi\Domain\Storefront;

use EolabsIo\YotpoApi\Domain\Shared\YotpoCore;
use EolabsIo\YotpoApi\Domain\Storefront\Concerns\ReviewQueryable;

class Review extends YotpoCore
{
    use ReviewQueryable;

    public function fetch()
    {
        // Reviews for Product
        $id = $this->getProductId();
        $endpoint = "/products/{$id}/reviews.json";
        $parameters = $this->getReviewQueryableParameters();

        return $this->get($endpoint, $parameters);
    }
}
