<?php namespace Describe\Contracts;

/**
 * Interface IStackTracer
 * @package Describe\Contracts
 */
interface IStackTracer
{
    /**
     * Trace current test file stack element.
     *
     * @param string $suffix
     * @param array  $merge
     *
     * @return array error details
     */
    public function trace($suffix, array $merge = []);
}
