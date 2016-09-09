<?php namespace Describe\Contracts;

/**
 * Interface ISyntax
 * @package Describe\Contracts
 */
interface ISyntax
{
    /** DESCRIBE syntax statements */
    const DESCRIBE_START = 'syntax.describe_start';
    const DESCRIBE_END = 'syntax.describe_end';

    /** CONTEXT syntax statements */
    const CONTEXT_START = 'syntax.context_start';
    const CONTEXT_END = 'syntax.context_end';

    /** IT syntax statements */
    const IT_START = 'syntax.it_start';
    const IT_END = 'syntax.it_end';
}
