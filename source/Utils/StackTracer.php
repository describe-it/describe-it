<?php namespace Describe\Utils;

use Describe\Contracts\DescribeException;
use Describe\Contracts\IStackTracer;

/**
 * Class StackTracer
 * @package Describe\Utils
 */
class StackTracer implements IStackTracer
{
    /** @inheritdoc */
    public function trace($suffix, array $merge = [])
    {
        $pattern = '/^.+\.' . $suffix . '.php$/';

        foreach (debug_backtrace() as $trace)
        {
            if (
                isset($trace['file'])
                && preg_match($pattern, $trace['file'])
            )
            {
                return array_merge($trace, $merge);
            }
        }

        $message = "Assertion error could not be created.";
        throw new DescribeException($message);
    }
}
