<?php namespace Describe\Contracts;

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