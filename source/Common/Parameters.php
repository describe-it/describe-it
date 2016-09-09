<?php namespace Describe\Common;

use Describe\Contracts\IParameters;
use Exception;

/**
 * Class Parameters
 * @package Describe\Common
 */
class Parameters implements IParameters
{
    const FLAG_PATTERN = '/^\-\-[a-zA-Z\-]+$/';
    const ARGUMENT_PATTERN = '/^\-\-[a-zA-Z\-]+=[a-zA-Z]+$/';

    /** @var array */
    protected $argv;

    /** @var array */
    protected $parameters;

    /**
     * Command constructor.
     *
     * @param array $argv
     * @param array $defaults
     */
    public function __construct(array $argv, array $defaults)
    {
        $this->argv = $argv;
        $this->parameters = $defaults;

        $this->parseArguments();
    }

    private function parseArguments()
    {
        foreach ($this->argv as $argument)
        {
            if (preg_match(Parameters::FLAG_PATTERN, $argument))
            {
                $this->parseFlag($argument);
            }
            if (preg_match(Parameters::ARGUMENT_PATTERN, $argument))
            {
                $this->parseArgument($argument);
            }
        }
    }

    private function parseFlag($argument)
    {
        $name = preg_replace('/[\-]{2}/', '', $argument);
        $this->parameters[$name] = !$this->parameters[$name];
    }

    private function parseArgument($argument)
    {
        $parts = explode('=', $argument);
        $name = preg_replace('/[\-]{2}/', '', $parts[0]);
        $value = $parts[1];
        $this->parameters[$name] = $value;
    }

    /** @inheritdoc */
    public function has($name)
    {
        return array_key_exists($name, $this->parameters);
    }

    /** @inheritdoc */
    public function get($name)
    {
        if (array_key_exists($name, $this->parameters))
        {
            return $this->parameters[$name];
        }
        else
        {
            $message = "{$name} parameter is not defined.";
            throw new Exception($message);
        }
    }
}
