<?php

namespace EolabsIo\YotpoApi\Tests\Unit\Domain\Storefront;

use EolabsIo\YotpoApi\Tests\Unit\BaseModelTest;
use EolabsIo\YotpoApi\Domain\Storefront\Models\ImagesData;

class ImagesDataTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ImagesData::class;
    }
}
