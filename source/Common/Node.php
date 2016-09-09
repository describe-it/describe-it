<?php namespace Describe\Common;

use Describe\Contracts\INode;

class Node implements INode
{
    /** @var string */
    protected $type;

    /** @var string */
    protected $mode;

    /** @var string */
    protected $message;

    /**
     * Event constructor.
     *
     * @param string $type
     * @param string $mode
     * @param string $message
     */
    public function __construct($type, $mode, $message = '')
    {
        $this->type = $type;
        $this->mode = $mode;
        $this->message = $message;
    }

    /** @inheritdoc */
    public function type()
    {
        return $this->type;
    }

    /** @inheritdoc */
    public function placement()
    {
        return $this->mode;
    }

    /** @inheritdoc */
    public function message()
    {
        return $this->message;
    }
}
