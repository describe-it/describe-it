<?php namespace Describe\Common;

use Describe\Contracts\IEvents;
use Describe\Contracts\IFormatter;
use Describe\Contracts\INode;
use Describe\Contracts\IOptions;
use Describe\Contracts\ISyntax;
use Exception;

abstract class Formatter implements IFormatter
{
    const RED = 'red';
    const GREEN = 'green';

    /** @var IEvents */
    protected $events;

    /** @var IOptions */
    protected $options;

    /** @var INode */
    protected $currentNode;

    /** @var array */
    protected $currentErrors = [];

    /** @var integer */
    protected $assertionsCount = 0;

    /** @var integer */
    protected $succeededAssertions = 0;

    /** @var integer */
    protected $failedAssertions = 0;

    /**
     * Formatter constructor.
     *
     * @param IEvents  $events
     * @param IOptions $options
     */
    public function __construct(
        IEvents $events,
        IOptions $options
    )
    {
        $this->events = $events;
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
        $header = "// {$type}: {$name}\n";
        $tseparator = "\n/* " . str_repeat('-', 60) . " */\n";
        $bseparator = "/* " . str_repeat('-', 60) . " */\n\n";

        $this->output($tseparator, null, false);
        $this->output($header, null, false);
        $this->output($bseparator, null, false);
    }

    protected function output($text, $color = null, $line = true)
    {
        $output = $text;

        if ($color == self::GREEN)
        {
            $output = "\033[32m {$text} \033[0m";
        }

        if ($color == self::RED)
        {
            $output = "\033[31m {$text} \033[0m";
        }

        echo $output;

        if ($line)
        {
            echo "\n";
        }
    }

    /** @inheritdoc */
    public function bind()
    {
        $this->events->register(IEvents::SUITE_CHANGED, [$this, 'heading']);
        $this->events->register(IEvents::ASSERTION_SUCCESS, [$this, 'processSuccess']);
        $this->events->register(IEvents::ASSERTION_FAILURE, [$this, 'processFailure']);

        $this->events->register(ISyntax::DESCRIBE, [$this, 'processSyntax']);
        $this->events->register(ISyntax::CONTEXT, [$this, 'processSyntax']);
        $this->events->register(ISyntax::IT, [$this, 'processSyntax']);
    }

    /**
     * Execute syntax processing.
     *
     * @param INode $node
     *
     * @throws Exception
     * @return void
     */
    public function processSyntax(INode $node)
    {
        if (
            $node->placement() == INode::OPENING
            && $node->type() == ISyntax::DESCRIBE
        )
        {
            $this->openDescribe($node);
        }
        elseif (
            $node->placement() == INode::CLOSING
            && $node->type() == ISyntax::DESCRIBE
        )
        {
            $this->closeDescribe($node);
        }
        elseif (
            $node->placement() == INode::OPENING
            && $node->type() == ISyntax::CONTEXT
        )
        {
            $this->openContext($node);
        }
        elseif (
            $node->placement() == INode::CLOSING
            && $node->type() == ISyntax::CONTEXT
        )
        {
            $this->closeContext($node);
        }
        elseif (
            $node->placement() == INode::OPENING
            && $node->type() == ISyntax::IT
        )
        {
            $this->setupCurrent($node);
            $this->openIt($this->currentNode);
        }
        elseif (
            $node->placement() == INode::CLOSING
            && $node->type() == ISyntax::IT
        )
        {
            $this->closeIt($this->currentNode);
        }
        else
        {
            $m = "Cannot process {$node->placement()} - {$node->type()} node.";
            throw new Exception($m);
        }
    }

    protected abstract function openDescribe(INode $node);

    protected abstract function closeDescribe(INode $node);

    protected abstract function openContext(INode $node);

    protected abstract function closeContext(INode $node);

    private function setupCurrent(INode $node)
    {
        $this->assertionsCount = 0;
        $this->succeededAssertions = 0;
        $this->failedAssertions = 0;
        $this->currentNode = $node;
        $this->currentErrors = [];
    }

    protected abstract function openIt(INode $node);

    protected abstract function closeIt(INode $node);

    public function processSuccess()
    {
        $this->assertionsCount++;
        $this->succeededAssertions++;
    }

    public function processFailure($message)
    {
        $this->assertionsCount++;
        $this->failedAssertions++;

        $stack = $this->stackTrace();

        $this->currentErrors[] = [
            'line'    => $stack['line'],
            'file'    => $stack['file'],
            'message' => $message,
        ];
    }

    private function stackTrace()
    {
        foreach (debug_backtrace() as $element)
        {
            if (isset($element['file']))
            {
                if (preg_match(
                    '/^.+\.' . $this->options->get('suffix') . ".php$/",
                    $element['file']
                ))
                {
                    return $element;
                }
            }
        }

        $m = "Something went very wrong!";
        throw new Exception($m);
    }

    protected function succeeded()
    {
        return $this->succeededAssertions == $this->assertionsCount;
    }
}