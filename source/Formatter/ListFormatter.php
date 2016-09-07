<?php namespace Describe\Formatter;

use Describe\Common\Formatter;
use Describe\Contracts\IEvents;
use Describe\Contracts\INode;
use Describe\Contracts\ISyntax;
use Exception;

class ListFormatter extends Formatter
{
    /** @var INode */
    protected $currentNode;

    /** @var integer */
    protected $failedExpectations = 0;

    /** @var integer */
    protected $indentation = 0;

    /** @inheritdoc */
    public function bind()
    {
        $this->events->register(IEvents::SUITE, [$this, 'heading']);
        $this->events->register(ISyntax::DESCRIBE, [$this, 'process']);
        $this->events->register(ISyntax::CONTEXT, [$this, 'process']);
        $this->events->register(ISyntax::IT, [$this, 'process']);
    }

    public function process(INode $node)
    {
        switch ($node->placement())
        {
            case ISyntax::OPENING:
                $this->start($node);
                break;

            case ISyntax::CLOSING:
                $this->end($node);
                break;

            default:
                $message = "{$node->placement()} syntax node placement is not defined.";
                throw new Exception($message);
        }
    }

    protected function start(INode $node)
    {
        switch ($node->type())
        {
            case ISyntax::DESCRIBE:
                $this->output($node);
                break;

            case ISyntax::CONTEXT:
                $this->open();
                $this->output($node);
                break;

            case ISyntax::IT:
                $this->open();
                $this->currentNode = $node;
                break;

            default:
                $message = "{$node->type()} syntax node type is not defined.";
                throw new Exception($message);
        }
    }

    protected function output(INode $node)
    {
        echo "{$this->tabs()}{$node->message()}\n";
    }

    protected function tabs()
    {
        return str_repeat(" ", $this->indentation * 4);
    }

    protected function open($count = 1)
    {
        $this->indentation += $count;
    }

    protected function end(INode $node)
    {
        switch ($node->type())
        {
            case ISyntax::DESCRIBE:
                break;

            case ISyntax::CONTEXT:
                $this->close();
                break;

            case ISyntax::IT:
                $this->output($this->currentNode);
                $this->close();
                break;

            default:
                $message = "{$node->type()} syntax node type is not defined.";
                throw new Exception($message);
        }
    }

    protected function close($count = 1)
    {
        $this->indentation -= $count;

        if ($this->indentation < 0)
        {
            $message = "Indentation cannot be smaller than zero.";
            throw new Exception($message);
        }
    }
}