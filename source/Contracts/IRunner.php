<?php namespace Describe\Contracts;

interface IRunner
{
    /**
     * Execute tests.
     *
     * @param string $suiteName
     */
    public function execute($suiteName = null);

    /**
     * Bind event listeners.
     */
    public function bind();
}
