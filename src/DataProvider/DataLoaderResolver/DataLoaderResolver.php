<?php

namespace App\DataProvider\DataLoaderResolver;

use App\DataProvider\DataLoader\DataLoaderCsv;
use App\DataProvider\DataLoader\DataLoaderInterface;
use App\DataProvider\DataLoader\DataLoaderJson;
use App\DataProvider\Exception\UnknownDataTypeException;

/**
 * Class DataLoaderResolver
 * @package App\DataProvider\DataLoaderResolver
 */
class DataLoaderResolver implements DataLoaderResolverInterface
{
    const ENV_VAR_DATA_SOURCE = 'DATA_SOURCE';

    const DATA_TYPE_JSON = 'json';
    const DATA_TYPE_CSV  = 'csv';

    const DEFAULT_FORMAT = self::DATA_TYPE_JSON;

    /** @var string */
    protected $dir;

    /**
     * DataLoaderResolver constructor.
     * @param string $dir
     */
    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    /**
     * @return DataLoaderInterface
     * @throws UnknownDataTypeException
     */
    public function getDataLoader(): DataLoaderInterface
    {
        $format = getenv(self::ENV_VAR_DATA_SOURCE);

        if (!$format) {
            $format = self::DATA_TYPE_JSON;
        }

        switch (true) {
            case ($format === self::DATA_TYPE_JSON):
                return new DataLoaderJson($this->dir);
                break;
            case ($format === self::DATA_TYPE_CSV):
                return new DataLoaderCsv($this->dir);
                break;
            default:
                throw new UnknownDataTypeException();
        }
    }
}