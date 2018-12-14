<?php

namespace Sameday\Requests\Traits;

/**
 * Trait to encapsulate request pagination.
 *
 * @package Sameday
 */
trait SamedayRequestPaginationTrait
{
    /**
     * @var int Page to request.
     */
    protected $page = 1;

    /**
     * @var int Count of elements to request.
     */
    protected $countPerPage = 50;

    /**
     * @inheritdoc
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the page to request.
     *
     * @param int $page
     *
     * @return self
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCountPerPage()
    {
        return $this->countPerPage;
    }

    /**
     * Set number of elements to request.
     *
     * @param int $countPerPage
     *
     * @return self
     */
    public function setCountPerPage($countPerPage)
    {
        $this->countPerPage = $countPerPage;

        return $this;
    }

    /**
     * Builds pagination parameters to use in request.
     *
     * @return array
     */
    protected function buildPagination()
    {
        return [
            'page' => $this->page,
            'countPerPage' => $this->countPerPage,
        ];
    }
}
