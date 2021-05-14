<?php

namespace EolabsIo\YotpoApi\Domain\Shared\Concerns;

trait InteractsWithBaseUrl
{

    /**
     * Get the Base URL.
     *
     * @return string
     */
    protected function getBaseUrl()
    {
        $baseUrl = config('services.yotpoApi.base_url', 'https://api.yotpo.com/v1/widget');
        $appKey = config('yotpo.app_key');

        return "{$baseUrl}/{$appKey}";
    }
}
