<?php

namespace EolabsIo\YotpoApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EolabsIo\YotpoApi\Skeleton\SkeletonClass
 */
class YotpoApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'yotpo-api';
    }
}
