<?php namespace Describe\Formatters;

use Describe\Common\Initializable;
use Describe\Contracts\DescribeException;
use Describe\Contracts\IErrorFactory;
use Describe\Contracts\IWriter;
use Describe\Utils\ErrorFactory;

/**
 * Class ListFormatter
 * @package Describe\Formatters
 */
class ListFormatter extends Initializable implements IWriter
{
    const GREEN = 'green';
    const RED = 'red';

    /** @var integer */
    protected $indentation = 0;

    /** @var integer */
    protected $indent = 4;

    /** @var IErrorFactory */
    protected $errorFactory;

    /**
     * ListFormatter constructor.
     *
     * @param array         $options
     * @param IErrorFactory $errorFactory
     *
     * @throws DescribeException
     */
    public function __construct(
        array $options,
        IErrorFactory $errorFactory = null
    )
    {
        parent::__construct($options);
        $this->errorFactory = $errorFactory ? $errorFactory : new ErrorFactory();
    }

    /** @inheritdoc */
    public function startSUITE($name)
    {
        $this->output();
        $this->output($name);
        $this->output();
    }

    /**
     * Print text to console.
     *
     * @param string|null $text
     * @param string|null $color
     */
    protected function output($text = null, $color = null)
    {
        $output = $text;

        switch ($color)
        {
            case self::GREEN:
                $output = "\033[32m {$text} \033[0m";
                break;

            case self::RED:
                $output = "\033[31m {$text} \033[0m";
                break;
        }

        echo $this->tabs() . $output . "\n";
    }

    /**
     * Get indentation string.
     *
     * @return string
     */
    protected function tabs()
    {
        return str_repeat(
            ' ',
            (integer)$this->indentation * (integer)$this->indent
        );
    }

    /** @inheritdoc */
    public function endSUITE()
    {
    }

    /** @inheritdoc */
    public function startDESCRIBE($message)
    {
    }

    /** @inheritdoc */
    public function endDESCRIBE()
    {
    }

    /** @inheritdoc */
    public function startCONTEXT($message)
    {
    }

    /** @inheritdoc */
    public function endCONTEXT()
    {
    }

    /** @inheritdoc */
    public function startIT()
    {
    }

    /** @inheritdoc */
    public function endIT()
    {
    }

    /** @inheritdoc */
    public function contentIT($message)
    {
    }

    /** @inheritdoc */
    public function contentSUCCESS()
    {
    }

    /** @inheritdoc */
    public function contentFAILURE($message)
    {
    }
}
