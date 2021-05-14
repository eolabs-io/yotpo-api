<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\YotpoApi\Domain\Storefront\Actions\PersistReviewAction;
use EolabsIo\YotpoApi\Domain\Storefront\Actions\PersistProductAction;

class ProcessFetchReviewResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Illuminate\Support\Collection */
    public $results;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $results)
    {
        $this->results = $results;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new PersistProductAction($this->results))->execute();
        (new PersistReviewAction($this->results))->execute();
    }
}
