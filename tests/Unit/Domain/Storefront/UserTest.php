<?php

namespace EolabsIo\YotpoApi\Tests\Unit\Domain\Storefront;

use EolabsIo\YotpoApi\Tests\Unit\BaseModelTest;
use EolabsIo\YotpoApi\Domain\Storefront\Models\User;

class UserTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return User::class;
    }
}
