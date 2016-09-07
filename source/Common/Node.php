<?php
/**
 * Created by PhpStorm.
 * User: lepcz
 * Date: 07.09.2016
 * Time: 16:49
 */

namespace Describe\Common;


use Describe\Contracts\INode;

class Node implements INode
{
    protected $type;
    protected $mode;
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