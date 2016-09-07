<?php namespace Describe\Contracts;

interface INode
{
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