<?php

namespace Sameday\Requests;

/**
 * Interface that encapsulates a paginated request.
 *
 * @package Sameday
 */
interface SamedayPaginatedRequestInterface extends SamedayRequestInterface
{
    /**
     * Return the page to be requested.
     *
     * @return int
     */
    public function getPage();

    /**
     * Return the number of elements to be requested.
     *
     * @return int
     */
    public function getCountPerPage();
}
