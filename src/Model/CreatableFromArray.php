<?php

namespace HappyrMatch\ApiClient\Model;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
interface CreatableFromArray
{
    /**
     * Create an API response object from the HTTP response from the API server.
     *
     * @return self
     */
    public static function createFromArray(array $data);
}
