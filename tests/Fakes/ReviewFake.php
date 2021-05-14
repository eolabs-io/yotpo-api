<?php

namespace EolabsIo\YotpoApi\Tests\Fakes;

use Illuminate\Support\Facades\Http;

class ReviewFake
{
    public $endpoint = 'https://api.yotpo.com/v1/widget/*';

    public function fake()
    {
        $reviewResponse = $this->getReviewResponse();

        Http::fake([
            $this->endpoint => Http::sequence()
                                   ->push($reviewResponse, 200)
                                   ->whenEmpty(Http::response('', 404)),
       ]);
    }

    public function getReviewResponse(): string
    {
        $file = __DIR__ . '/../Stubs/Responses/Reviews.json';
        return file_get_contents($file);
    }
}
