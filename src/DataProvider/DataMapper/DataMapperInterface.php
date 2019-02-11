<?php

namespace App\DataProvider\DataMapper;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DataMapperInterface
 * @package App\DataProvider\DataMapper
 */
interface DataMapperInterface
{
    public function map(array $data): ArrayCollection;
}