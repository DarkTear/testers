<?php

namespace App\DataProvider\DataLoaderResolver;

use App\DataProvider\DataLoader\DataLoaderInterface;

/**
 * Interface DataLoaderResolverInterface
 * @package App\DataProvider\DataLoaderResolver
 */
interface DataLoaderResolverInterface
{
    public function getDataLoader(): DataLoaderInterface;
}