<?php namespace Describe\Contracts;

interface IBinding
{
    /**
     * Emmit assertion success event.
     *
     * @return void
     */
    public function emmitAssertionSuccess();

    /**
     * Emmit assertion failure event.
     *
     * @param string $message
     *
     * @return void
     */
    public function emmitAssertionFailure($message);
}