<?php namespace Describe\Formatter;

use Describe\Common\Formatter;
use Describe\Contracts\INode;

class ListFormatter extends Formatter
{
    /** @var integer */
    protected $currentIndentation = 0;

    /** @inheritdoc */
    protected function openDescribe(INode $node)
    {
        $this->output("{$this->tabs()}{$node->message()}");
    }

    protected function tabs()
    {
        return str_repeat(" ", $this->currentIndentation * 4);
    }

    /** @inheritdoc */
    protected function closeDescribe(INode $node)
    {
        $this->output("");
    }

    /** @inheritdoc */
    protected function openContext(INode $node)
    {
        $this->currentIndentation++;
        $this->output("");
        $this->output("{$this->tabs()}{$node->message()}");
    }

    /** @inheritdoc */
    protected function closeContext(INode $node)
    {
        $this->currentIndentation--;
    }

    /** @inheritdoc */
    protected function openIt(INode $node)
    {
        $this->currentIndentation++;
    }

    /** @inheritdoc */
    protected function closeIt(INode $node)
    {
        $color = $this->succeeded() ? self::GREEN : self::RED;
        $icon = $this->succeeded() ? '*' : 'x';
        $count = "({$this->succeededAssertions}/{$this->assertionsCount})";

        $this->output("{$this->tabs()}{$icon} {$node->message()} {$count}", $color);
        if (!$this->succeeded())
        {
            $this->outputErrors();
        }

        $this->currentIndentation--;
    }

    private function outputErrors()
    {
        foreach ($this->currentErrors as $index => $error)
        {
            if ($index == 0)
            {
                $this->output("");
            }
            $this->output("{$this->tabs()}  {$error['message']}", self::RED);
            $this->output("{$this->tabs()}  line: {$error['line']} in {$error['file']}", self::RED);
            $this->output("");
        }
    }
}