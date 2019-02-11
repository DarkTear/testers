<?php

namespace App\DataProvider\DataMapper;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DataMapper
 * @package App\DataProvider\DataMapper
 */
class DataMapperUser implements DataMapperInterface
{
    const FIELDS_MAP = [
        "login",
        "password",
        "title",
        "lastname",
        "firstname",
        "gender",
        "email",
        "picture",
        "address"
    ];

    /**
     * @param ArrayCollection $arrayCollection
     * @param array $data
     * @return ArrayCollection|User[]
     */
    public function map(array $data): ArrayCollection
    {
        $collection = new ArrayCollection();

        foreach ($data as $datum) {
            $user = new User();

            if (array_keys($datum) !== range(0, count($datum) - 1)) {
                foreach (self::FIELDS_MAP as $field) {
                    if (isset($datum[$field])) {
                        $user->{'set' . $field }((string)$datum[$field]);
                    }
                }
            } else {
                foreach (self::FIELDS_MAP as $k => $field) {
                    if (isset($datum[$k])) {
                        $user->{'set' . $field}((string)$datum[$k]);
                    }
                }
            }


            $collection->add($user);
        }

        return $collection;
    }
}