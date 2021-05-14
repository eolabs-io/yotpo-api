<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Concerns;

trait ReviewQueryable
{
    /** @var array */
    private $reviewQueryableParameters = [
        'per_page' => null,
        'page' => null,
        'star' => null,
        'sort' => null,
        'direction' => null,
    ];

    /** @var string */
    private $productId;

    public function withProductId($id = null): self
    {
        $this->productId = $id;

        return $this;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function hasProductId(): bool
    {
        return filled($this->productId);
    }

    public function withPerPage($perPage = null): self
    {
        $this->reviewQueryableParameters['per_page'] = $perPage;

        return $this;
    }

    public function withPage($page = null): self
    {
        $this->reviewQueryableParameters['page'] = $page;

        return $this;
    }

    public function withStar($star = null): self
    {
        if ($star < 1 || $star > 5) {
            $star = null;
        }

        $this->reviewQueryableParameters['star'] = $star;

        return $this;
    }

    public function withNoSort(): self
    {
        $this->reviewQueryableParameters['sort'] = null;
        $this->reviewQueryableParameters['direction'] = null;

        return $this;
    }

    public function withSortDate(): self
    {
        $this->reviewQueryableParameters['sort'] = 'date';

        return $this;
    }

    public function withSortVotesUp(): self
    {
        $this->reviewQueryableParameters['sort'] = 'votes_up';

        return $this;
    }

    public function withSortVotesDown(): self
    {
        $this->reviewQueryableParameters['sort'] = 'votes_down';

        return $this;
    }

    public function withSortTime(): self
    {
        $this->reviewQueryableParameters['sort'] = 'time';

        return $this;
    }

    public function withSortRating(): self
    {
        $this->reviewQueryableParameters['sort'] = 'rating';

        return $this;
    }

    public function withSortReviewerType(): self
    {
        $this->reviewQueryableParameters['sort'] = 'reviewer_type';

        return $this;
    }

    public function withDirectionAsc(): self
    {
        $this->reviewQueryableParameters['direction'] = 'asc';

        return $this;
    }

    public function withDirectionDesc(): self
    {
        $this->reviewQueryableParameters['direction'] = 'desc';

        return $this;
    }

    public function getReviewQueryableParameters(): array
    {
        return array_filter($this->reviewQueryableParameters);
    }
}
