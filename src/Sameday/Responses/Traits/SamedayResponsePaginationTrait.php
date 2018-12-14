<?php

namespace Sameday\Responses\Traits;

use Sameday\Requests\SamedayPaginatedRequestInterface;

/**
 * Trait to encapsulate response pagination.
 *
 * @package Sameday
 */
trait SamedayResponsePaginationTrait
{
    /**
     * @var int Total number of elements.
     */
    protected $total = 0;

    /**
     * @var int Current page.
     */
    protected $currentPage;

    /**
     * @var int Total number of pages.
     */
    protected $pages = 0;

    /**
     * @var int Number of elements per page.
     */
    protected $perPage;

    /**
     * @inheritdoc
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @inheritdoc
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @inheritdoc
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @inheritdoc
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * Parse pagination response.
     *
     * @param SamedayPaginatedRequestInterface $request
     * @param array|null $data
     */
    protected function parsePagination(SamedayPaginatedRequestInterface $request, array $data = null)
    {
        $this->currentPage = $request->getPage();
        $this->perPage = $request->getCountPerPage();

        if (!$data) {
            return;
        }

        $this->total = $data['total'];
        $this->currentPage = $data['currentPage'];
        $this->pages = $data['pages'];
        $this->perPage = $data['perPage'];
    }
}
