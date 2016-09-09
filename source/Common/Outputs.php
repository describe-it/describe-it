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
     * @param array $output
     *
     * @throws DescribeException
     */
    public function create(array $output)
    {
        $class = self::FO_NS . ucfirst($output['type']) . 'Formatter';

        if (
            !class_exists($class)
            || !in_array(self::WR_IN, class_implements($class))
        )
        {
            $message = "{$output['type']} output format is not supported.";
            throw new DescribeException($message);
        }

        $this->outputs[] = new $class($output);
    }

    /** @inheritdoc */
    public function suiteStart($name)
    {
        foreach ($this->outputs as $output)
        {
            $output->suiteStart($name);
        }
    }

    /** @inheritdoc */
    public function suiteEnd($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->suiteEnd($message);
        }
    }

    /** @inheritdoc */
    public function describeStart($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->describeStart($message);
        }
    }

    /** @inheritdoc */
    public function describeEnd($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->describeEnd($message);
        }
    }

    /** @inheritdoc */
    public function contextStart($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->contextStart($message);
        }
    }

    /** @inheritdoc */
    public function contextEnd($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->contextEnd($message);
        }
    }

    /** @inheritdoc */
    public function itStart($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->itStart($message);
        }
    }

    /** @inheritdoc */
    public function itEnd($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->itEnd($message);
        }
    }

    /** @inheritdoc */
    public function onBefore()
    {
        foreach ($this->outputs as $output)
        {
            $output->onBefore();
        }
    }

    /** @inheritdoc */
    public function onSuccess()
    {
        foreach ($this->outputs as $output)
        {
            $output->onSuccess();
        }
    }

    /** @inheritdoc */
    public function onFailure($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->onFailure($message);
        }
    }
}
