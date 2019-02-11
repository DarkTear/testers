<?php

namespace App\DataProvider\DataLoader;

/**
 * Interface DataLoaderInterface
 * @package App\DataProvider\DataLoader
 */
interface DataLoaderInterface
{
    /**
     * @return array
     */
    public function load(): array;
}