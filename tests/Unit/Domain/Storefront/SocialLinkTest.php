<?php

namespace EolabsIo\YotpoApi\Tests\Unit\Domain\Storefront;

use EolabsIo\YotpoApi\Tests\Unit\BaseModelTest;
use EolabsIo\YotpoApi\Domain\Storefront\Models\SocialLink;

class SocialLinkTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return SocialLink::class;
    }
}
