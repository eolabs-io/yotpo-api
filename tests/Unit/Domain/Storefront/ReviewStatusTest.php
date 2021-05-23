<?php

namespace EolabsIo\YotpoApi\Tests\Unit\Domain\Storefront;

use EolabsIo\YotpoApi\Tests\Unit\BaseModelTest;
use EolabsIo\YotpoApi\Domain\Storefront\Models\ReviewStatus;

class ReviewStatusTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ReviewStatus::class;
    }
}
