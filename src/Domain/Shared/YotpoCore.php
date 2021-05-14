<?php

namespace EolabsIo\YotpoApi\Domain\Shared;

use Illuminate\Support\Str;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use EolabsIo\YotpoApi\Domain\Shared\Concerns\HasPaginatedResults;
use EolabsIo\YotpoApi\Domain\Shared\Concerns\InteractsWithBaseUrl;

abstract class YotpoCore
{
    use InteractsWithBaseUrl,
        HasPaginatedResults;

    public function __construct()
    {
    }

    public function getUrl(string $endpoint): string
    {
        return $this->getBaseUrl() . Str::start($endpoint, '/');
    }

    abstract public function fetch();

    public function get(string $endpoint, array $parameters = [])
    {
        try {
            if ($this->hasNextPage()) {
                $parameters = array_merge($parameters, $this->getNextPageParameters());
            }

            $headers = $this->getHeaderFields();
            $response = Http::withHeaders($headers)
                            ->get($this->getUrl($endpoint), $parameters)
                            ->throw();

            return $this->processResponse($response);
        } catch (RequestException $requestException) {
            $this->handleException($requestException);
        }
    }

    public function processResponse(Response $response)
    {
        $results = collect(json_decode($response->getBody(), true));
        $this->checkForPagination($results);

        return $results;
    }

    /**
     * Get the Header fields for the token request.
     *
     * @return array
     */
    protected function getHeaderFields(): array
    {
        return ['Content-Type' => 'application/json'];
    }

    protected function handleException(RequestException $requestException)
    {
        $status = $requestException->response->status();
        switch ($status) {
            default:
                throw $requestException;
        }
    }
}
