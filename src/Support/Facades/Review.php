<?php

namespace EolabsIo\YotpoApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\YotpoApi\Tests\Fakes\ReviewFake;

/**
 * @see EolabsIo\YotpoApi\Domain\Storefront\Review
 */
class Review extends Facade
{
    public static function fake($options = [])
    {
        $type = data_get($options, 'type');

        $fake = static::getFake($type);
        $fake->fake();

        return $fake;
    }

    public static function getFake($type): ReviewFake
    {
        switch ($type) {
            default:
                return new ReviewFake;
        }
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'yotpo-api-review';
    }
}
