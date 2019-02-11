<?php

namespace App\DataProvider\DataLoader;

use App\DataProvider\Exception\DataFileNotExistsException;

/**
 * Class AbstractDataLoader
 * @package App\DataProvider\DataLoader
 */
abstract class AbstractDataLoader implements DataLoaderInterface
{
    protected const FILE_NAME = '/data/testtakers';

    /** @var string */
    protected $dir;

    /** @var string|null */
    protected $format;

    /**
     * AbstractDataLoader constructor.
     * @param string $dir
     */
    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    /**
     * @throws DataFileNotExistsException
     */
    protected function loadFile(): string
    {
        $filename = $this->dir . self::FILE_NAME . '.' . $this->format;

        $file = file_get_contents($filename);

        if (!$file) {
            throw new DataFileNotExistsException();
        }
        return $file;
    }

    /**
     * @inheritdoc
     */
    public function load(): array
    {
        try {
            $file = $this->loadFile();
        } catch (DataFileNotExistsException $e) {
            return [];
        }

        $data = $this->parseData($file);

        return $data;
    }

    /**
     * @param string $file
     * @return array
     */
    abstract protected function parseData(string $file): array;
}