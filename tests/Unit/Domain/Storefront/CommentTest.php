<?php

namespace EolabsIo\YotpoApi\Tests\Unit\Domain\Storefront;

use EolabsIo\YotpoApi\Tests\Unit\BaseModelTest;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Comment;

class CommentTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Comment::class;
    }
}
