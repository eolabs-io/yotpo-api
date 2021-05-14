<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Providers;

use EolabsIo\YotpoApi\Domain\Storefront\Events\FetchReview;
use EolabsIo\YotpoApi\Domain\Storefront\Command\ReviewCommand;
use EolabsIo\YotpoApi\Domain\Storefront\Listeners\FetchReviewListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchReview::class => [
            FetchReviewListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Registering package commands.
        $this->commands([
            ReviewCommand::class,
        ]);
    }
}
