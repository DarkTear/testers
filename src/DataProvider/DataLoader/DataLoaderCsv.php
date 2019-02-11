<?php

namespace App\DataProvider\DataLoader;

use App\DataProvider\DataLoaderResolver\DataLoaderResolver;

/**
 * Class DataLoaderCsv
 * @package App\DataProvider\DataLoader
 */
class DataLoaderCsv extends AbstractDataLoader
{
    /** @var string */
    protected $format = DataLoaderResolver::DATA_TYPE_CSV;

    /**
     * @inheritdoc
     */
    public function parseData(string $file): array
    {
        $data = [];

        $fileRows = explode(PHP_EOL, $file);
        array_shift($fileRows);

        foreach ($fileRows as $fileRow) {
            $datum = str_getcsv($fileRow);
            $data[] = $datum;
        }

        return $data;
    }
}