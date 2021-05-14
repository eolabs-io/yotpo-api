<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Command;

use Illuminate\Console\Command;
use EolabsIo\YotpoApi\Domain\Storefront\Review;
use EolabsIo\YotpoApi\Domain\Storefront\Events\FetchReview;

class ReviewCommand extends Command
{
    protected $signature = 'yotpoApi:review
                            {--product-id= : Return only review specified by Product Id.}
                            {--per-page= : Returns reviews per page.}
                            {--page= : Page number to return reviews for.}
                            {--star= : Return reviews with star rating for the product (1 to 5).}
                            {--no-sort : Do not sort reviews.}
                            {--sort-date : Sort reviews by date.}
                            {--sort-votes-up : Sort reviews by Votes Up.}
                            {--sort-votes-down : Sort reviews by Votes Down.}
                            {--sort-time : Sort reviews by Time.}
                            {--sort-rating : Sort reviews by Rating.}
                            {--sort-reviewer-type : Sort reviews by Reviewer Type.}
                            {--direction-asc : Sort reviews asc.}
                            {--direction-desc : Sort reviews desc.}';


    protected $description = 'Gets reviews from Yotpo';


    public function handle()
    {
        $this->info('Getting reviews from Yotpo...');

        $review = new Review;

        $review = $this->applyOptions($review);

        FetchReview::dispatch($review);
    }

    public function applyOptions(Review $review): Review
    {
        // Apply options
        if ($id = $this->option('product-id')) {
            $review->withProductId($id);
        }

        if ($perPage = $this->option('per-page')) {
            $review->withPerPage($perPage);
        }

        if ($page = $this->option('page')) {
            $review->withPage($page);
        }

        if ($star = $this->option('star')) {
            $review->withStar($star);
        }

        if ($sortDate = $this->option('no-sort')) {
            $review->withNoSort();
        }

        if ($sortDate = $this->option('sort-date')) {
            $review->withSortDate();
        }

        if ($sortVotesUp = $this->option('sort-votes-up')) {
            $review->withSortVotesUp();
        }

        if ($sortVotesDown = $this->option('sort-votes-down')) {
            $review->withSortVotesDown();
        }

        if ($sortVotesTime = $this->option('sort-time')) {
            $review->withSortTime();
        }

        if ($sortVotesRating = $this->option('sort-rating')) {
            $review->withSortRating();
        }

        if ($sortReviewerType = $this->option('sort-reviewer-type')) {
            $review->withSortReviewerType();
        }

        if ($sortDirectionAsc = $this->option('direction-asc')) {
            $review->withDirectionAsc();
        }

        if ($sortDirectionDesc = $this->option('direction-desc')) {
            $review->withDirectionDesc();
        }

        return $review;
    }
}
