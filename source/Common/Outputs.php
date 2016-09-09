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
    public function startSUITE($name)
    {
        foreach ($this->outputs as $output)
        {
            $output->startSUITE($name);
        }
    }

    /** @inheritdoc */
    public function endSUITE()
    {
        foreach ($this->outputs as $output)
        {
            $output->endSUITE();
        }
    }

    /** @inheritdoc */
    public function startDESCRIBE($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->startDESCRIBE($message);
        }
    }

    /** @inheritdoc */
    public function endDESCRIBE()
    {
        foreach ($this->outputs as $output)
        {
            $output->endDESCRIBE();
        }
    }

    /** @inheritdoc */
    public function startCONTEXT($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->startCONTEXT($message);
        }
    }

    /** @inheritdoc */
    public function endCONTEXT()
    {
        foreach ($this->outputs as $output)
        {
            $output->endCONTEXT();
        }
    }

    /** @inheritdoc */
    public function startIT()
    {
        foreach ($this->outputs as $output)
        {
            $output->startIT();
        }
    }

    /** @inheritdoc */
    public function contentIT($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->contentIT($message);
        }
    }

    /** @inheritdoc */
    public function endIT()
    {
        foreach ($this->outputs as $output)
        {
            $output->endIT();
        }
    }

    /** @inheritdoc */
    public function contentSUCCESS()
    {
        foreach ($this->outputs as $output)
        {
            $output->contentSUCCESS();
        }
    }

    /** @inheritdoc */
    public function contentFAILURE($message)
    {
        foreach ($this->outputs as $output)
        {
            $output->contentFAILURE($message);
        }
    }
}
