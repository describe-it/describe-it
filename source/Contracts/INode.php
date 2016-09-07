<?php namespace Describe\Contracts;

interface INode
{
    const OPENING = 'placement.opening';
    const CLOSING = 'placement.closing';

    /**
     * Get node type.
     *
     * @return string
     */
    public function type();

    /**
     * Get node placement.
     *
     * @return string
     */
    public function placement();

    /**
     * Get mode message.
     *
     * @return string
     */
    public function message();
}