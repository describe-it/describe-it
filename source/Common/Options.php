<?php namespace Describe\Common;

use Describe\Contracts\IOptions;
use Exception;

/**
 * Class Options
 * @package Describe\Common
 */
class Options implements IOptions
{
    /** @var string */
    private $path;

    /** @var array */
    private $options;

    /**
     * Options constructor.
     *
     * @param string $cwd
     * @param string $filename
     * @param array  $defaults
     *
     * @throws Exception
     */
    public function __construct($cwd, $filename, array $defaults)
    {
        $this->options = $defaults;
        $this->options['cwd'] = $cwd;
        $this->path = "{$cwd}/{$filename}.json";

        if (file_exists($this->path))
        {
            $this->options = array_merge(
                $this->options,
                json_decode(file_get_contents($this->path), true)
            );
        }
        else
        {
            echo "Configuration file not found - using defaults.\n";
        }
    }

    /** @inheritdoc */
    public function get($path)
    {
        $parts = explode('.', $path);
        $result = $this->options;

        foreach ($parts as $part)
        {
            if (array_key_exists($part, $result))
            {
                $result = $result[$part];
            }
            else
            {
                $message = "{$path} option is not defined.";
                throw new Exception($message);
            }
        }

        return $result;
    }
}
