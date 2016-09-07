<?php namespace Describe\Common;

use Describe\Contracts\IEvents;
use Describe\Contracts\IFormatter;
use Describe\Contracts\IOptions;
use Describe\Contracts\IParameters;

abstract class Formatter implements IFormatter
{
    /** @var IEvents */
    protected $events;

    /** @var IParameters */
    protected $parameters;

    /** @var IOptions */
    protected $options;

    /**
     * Formatter constructor.
     *
     * @param IEvents     $events
     * @param IParameters $parameters
     * @param IOptions    $options
     */
    public function __construct(
        IEvents $events,
        IParameters $parameters,
        IOptions $options
    )
    {
        $this->events = $events;
        $this->parameters = $parameters;
        $this->options = $options;
    }

    /**
     * Output pretty formatted heading.
     *
     * @param string $name
     * @param string $type
     *
     * @return void
     */
    public function heading($name, $type = 'SUITE')
    {
        echo "\n/** " . str_repeat('-', 60) . " */\n";
        echo "// {$type}: {$name}\n";
        echo '/** ' . str_repeat('-', 60) . " */\n\n";
    }

    /** @inheritdoc */
    public abstract function bind();
}