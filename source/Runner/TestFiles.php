<?php namespace Describe\Runner;

use Describe\Contracts\DescribeException;
use Describe\Contracts\IFiles;
use Exception;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class TestFiles
 * @package Describe\Runner
 */
class TestFiles implements IFiles
{
    /** @var string */
    protected $cwd;

    /**
     * TestFiles constructor.
     *
     * @param string $cwd
     */
    public function __construct($cwd)
    {
        $this->cwd = $cwd;
    }

    /** @inheritdoc */
    public function find($directory, $suffix)
    {
        try
        {
            $path = "{$this->cwd}/{$directory}/";
            $pattern = ".{$suffix}.php";

            $files = [];
            $iterator = new RecursiveDirectoryIterator($path);

            foreach (new RecursiveIteratorIterator($iterator) as $file)
            {
                if (strpos($file, $pattern) !== false)
                {
                    $files[] = $file->getPathName();
                }
            }

            return $files;
        }
        catch (Exception $e)
        {
            $message = "{$directory} test suite directory does not exist.";
            throw new DescribeException($message);
        }
    }

    /** @inheritdoc */
    public function execute($path)
    {
        /** @noinspection PhpIncludeInspection */
        require($path);
    }
}
