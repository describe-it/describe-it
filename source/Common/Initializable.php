<?php namespace Describe\Common;

use Describe\Contracts\DescribeException;
use Exception;

abstract class Initializable
{
    /**
     * Initializable constructor.
     *
     * @param array $options to initialize from
     *
     * @throws DescribeException
     */
    public function __construct(array $options)
    {
        foreach ($options as $option => $value)
        {
            try
            {
                $this->$option = $value;
            }
            catch (Exception $e)
            {
                $message = "Unrecognized {$option} option detected.";
                throw new DescribeException($message);
            }
        }
    }
}
