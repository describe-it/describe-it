<?php namespace Describe\Contracts;

interface IParameters
{
    /**
     * Obtain parameter value.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get($name);
}