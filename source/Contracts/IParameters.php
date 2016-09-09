<?php namespace Describe\Contracts;

/**
 * Interface IParameters
 * @package Describe\Contracts
 */
interface IParameters
{
    /**
     * Whether a parameter exists.
     *
     * @param string $name
     *
     * @return boolean
     */
    public function has($name);

    /**
     * Obtain parameter value.
     *
     * @param string $name
     *
     * @return string
     */
    public function get($name);
}
