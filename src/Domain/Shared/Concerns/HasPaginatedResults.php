<?php

namespace EolabsIo\YotpoApi\Domain\Shared\Concerns;

use Illuminate\Support\Collection;

trait HasPaginatedResults
{
    private $pagination = [
        'page' => null,
        'per_page' => null,
        'total' => null,
    ];

    public function checkForPagination(Collection $response)
    {
        $this->pagination['page'] = data_get($response, 'response.pagination.page');
        $this->pagination['per_page'] = data_get($response, 'response.pagination.per_page');
        $this->pagination['total'] = data_get($response, 'response.pagination.total');
    }

    public function hasPreviousPage(): bool
    {
        $page = $this->getPage();
        return $page > 1;
    }

    public function getPreviousPageParameters(): array
    {
        if ($this->hasPreviousPage()) {
            return [
                'page' => $this->getPage() - 1,
                'per_page' => $this->getPerPage(),
            ];
        }

        return [];
    }

    public function hasNextPage(): bool
    {
        $numberOfPages = $this->getNumberOfPages();
        $page = $this->getPage();
        return $page < $numberOfPages;
    }

    public function getNextPageParameters(): array
    {
        if ($this->hasNextPage()) {
            return [
                'page' => $this->getPage() + 1,
                'per_page' => $this->getPerPage(),
            ];
        }

        return [];
    }

    public function getNumberOfPages(): int
    {
        $total = $this->getTotal();
        $perPage = $this->getPerPage();

        return ceil($total/$perPage);
    }

    public function getPage(): int
    {
        return data_get($this->pagination, 'page') ?? 1;
    }

    public function getTotal(): int
    {
        return data_get($this->pagination, 'total') ?? 0;
    }

    public function getPerPage(): int
    {
        return data_get($this->pagination, 'per_page') ?? 1;
    }
}
