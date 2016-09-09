<?php namespace Describe\Contracts;

/**
 * Interface IRunner
 * @package Describe\Contracts
 */
interface IRunner
{
    /**
     * Schedule test suite execution.
     *
     * @param ISuite $suite
     */
    public function schedule(ISuite $suite);

    /**
     * Execute test suites.
     */
    public function run();
}
