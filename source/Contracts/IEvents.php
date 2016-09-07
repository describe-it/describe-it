<?php namespace Describe\Contracts;

interface IEvents
{
    const SUITE = 'event.suite';

    /**
     * Register event handler.
     *
     * @param string   $name
     * @param callable $handler
     *
     * @return void
     */
    public function register($name, $handler);

    /**
     * Emmit an event.
     *
     * @param string $name
     * @param mixed  $argument
     *
     * @return void
     */
    public function emmit($name, $argument);
}