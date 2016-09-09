<?php namespace Describe\Contracts;

interface IEvents
{
    const SUITE_CHANGED = 'event.suite';
    const ASSERTION_SUCCESS = 'event.assertion_success';
    const ASSERTION_FAILURE = 'event.assertion_failure';

    /**
     * Register event handler.
     *
     * @param string   $name
     * @param callable $handler
     */
    public function register($name, $handler);

    /**
     * Emmit new event.
     *
     * @param string $name
     * @param mixed  $argument
     */
    public function emmit($name, $argument = null);
}
