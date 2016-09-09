<?php namespace Describe\Common;

use Describe\Contracts\DescribeException;
use Describe\Contracts\IWriter;

/**
 * Class Outputs
 * @package Describe\Common
 */
class Outputs implements IWriter
{
    /** Formatters namespace */
    const FO_NS = "Describe\\Formatters\\";

    /** Writer interface */
    const WR_IN = "Describe\\Contracts\\IWriter";

    /** @var IWriter[] */
    protected $outputs = [];

    /**
     * Create new output.
     *
     * @param array $options
     *
     * @throws DescribeException
     */
    public function create(array $options)
    {
        $class = self::FO_NS . ucfirst($options['type']) . 'Output';

        if (
            !class_exists($class)
            || !in_array(self::WR_IN, class_implements($class))
        )
        {
            $message = "{$options['type']} output format is not supported.";
            throw new DescribeException($message);
        }

        $this->outputs[] = new $class($options);
    }

    /** @inheritdoc */
    public function closeContext($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->closeContext($message);
        }
    }

    /** @inheritdoc */
    public function closeDescribe($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->closeDescribe($message);
        }
    }

    /** @inheritdoc */
    public function closeIt($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->closeIt($message);
        }
    }

    /** @inheritdoc */
    public function closeSuite($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->closeSuite($message);
        }
    }

    /** @inheritdoc */
    public function openContext($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->openContext($message);
        }
    }

    /** @inheritdoc */
    public function openDescribe($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->openDescribe($message);
        }
    }

    /** @inheritdoc */
    public function openIt($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->openIt($message);
        }
    }

    /** @inheritdoc */
    public function openSuite($name)
    {
        foreach ($this->outputs as $output)
        {
            $output->openSuite($name);
        }
    }

    /** @inheritdoc */
    public function outputBefore()
    {
        foreach ($this->outputs as $output)
        {
            $output->outputBefore();
        }
    }

    /** @inheritdoc */
    public function outputFailure(array $error)
    {
        foreach ($this->outputs as $output)
        {
            $output->outputFailure($error);
        }
    }

    /** @inheritdoc */
    public function outputSuccess(array $success)
    {
        foreach ($this->outputs as $output)
        {
            $output->outputSuccess($success);
        }
    }
}
