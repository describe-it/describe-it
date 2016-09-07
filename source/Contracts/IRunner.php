<?php namespace Describe\Contracts;

interface IRunner
{
    /**
     * Execute tests.
     *
     * @return void
     */
    public function run();

    /**
     * Bind event listeners.
     *
     * @return void
     */
    public function bind();
}