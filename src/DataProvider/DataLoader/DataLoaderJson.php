<?php

namespace App\DataProvider\DataLoader;

use App\DataProvider\DataLoaderResolver\DataLoaderResolver;

/**
 * Class DataLoaderJson
 * @package App\DataProvider\DataLoader
 */
class DataLoaderJson extends AbstractDataLoader
{
    /** @var string */
    protected $format = DataLoaderResolver::DATA_TYPE_JSON;

    /**
     * @inheritdoc
     */
    public function parseData(string $file): array
    {
        $data = json_decode($file, true);

        if (!is_array($data)) {
            $data = [];
        }

        return $data;
    }
}