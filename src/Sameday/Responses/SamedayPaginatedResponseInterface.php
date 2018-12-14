<?php

namespace Sameday\Responses;

/**
 * Interface that encapsulates a paginated response.
 *
 * @package Sameday
 */
interface SamedayPaginatedResponseInterface extends SamedayResponseInterface
{
    /**
     * Return total number of elements.
     *
     * @return int
     */
    public function getTotal();

    /**
     * Return current page.
     *
     * @return int
     */
    public function getCurrentPage();

    /**
     * Return total number of pages.
     *
     * @return int
     */
    public function getPages();

    /**
     * Return number of elements per page.
     *
     * @return int
     */
    public function getPerPage();
}
