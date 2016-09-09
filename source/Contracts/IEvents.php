<?php namespace Describe\Contracts;

/**
 * Interface IEvents
 * @package Describe\Contracts
 */
interface IEvents
{
    /** Syntax statement event */
    const SYNTAX = 'event.syntax';

    /** Before assertion event */
    const BEFORE = 'event.before';

    /** Assertion success event */
    const SUCCESS = 'event.success';

    /** Assertion failure event */
    const FAILURE = 'event.failure';

    /**
     * Register event handler.
     *
     * @param string   $name
     * @param callable $handler
     */
    public function register($name, $handler);

    /**
     * Remove event handler.
     *
     * @param string   $name
     * @param callable $handler
     */
    public function remove($name, $handler);

    /**
     * Emmit an event.
     *
     * @param string $name
     * @param mixed  $arguments
     */
    public function emmit($name, $arguments = []);
}
