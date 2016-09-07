<?php namespace Describe\Contracts;

interface IBinding
{
    /**
     * Emmit assertion success event.
     *
     * @return void
     */
    public function onAssertionSuccess();

    /**
     * Emmit assertion failure event.
     *
     * @param string $message
     *
     * @return void
     */
    public function onAssertionFailure($message);
}