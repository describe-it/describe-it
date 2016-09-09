<?php namespace Describe\Contracts;

/**
 * Interface IFiles
 * @package Describe\Contracts
 */
interface IFiles
{
    /**
     * Find test files.
     *
     * @param string $directory
     * @param string $suffix
     *
     * @return array
     */
    public function find($directory, $suffix);

    /**
     * Execute test file.
     *
     * @param string $path
     */
    public function execute($path);
}
