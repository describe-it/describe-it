<?php namespace Describe\Contracts;

/**
 * Interface IErrorFactory
 * @package Describe\Contracts
 */
interface IErrorFactory
{
    /**
     * Create assertion error.
     *
     * @param string $message current error message
     * @param string $suffix  current test file suffix
     *
     * @return array error details
     */
    public function create($message, $suffix);
}
