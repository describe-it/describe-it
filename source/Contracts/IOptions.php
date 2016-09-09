<?php namespace Describe\Contracts;

/**
 * Interface IOptions
 * @package Describe\Contracts
 */
interface IOptions
{
    /**
     * Obtain option value.
     *
     * @param string $path
     *
     * @return mixed
     */
    public function get($path);
}
