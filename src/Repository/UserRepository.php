<?php
namespace App\Repository;


use App\DataProvider\DataLoader\DataLoaderInterface;
use App\DataProvider\DataLoaderResolver\DataLoaderResolverInterface;
use App\DataProvider\DataMapper\DataMapperInterface;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class UserRepository
{
    /** @var DataLoaderInterface */
    private $dataLoader;

    /** @var DataMapperInterface */
    private $dataMapper;

    public function __construct(DataLoaderResolverInterface $dataLoaderResolver, DataMapperInterface $dataMapper)
    {
        $this->dataLoader = $dataLoaderResolver->getDataLoader();
        $this->dataMapper = $dataMapper;
    }

    /**
     * @return ArrayCollection|User[]
     */
    private function loadData(): ArrayCollection
    {
        return $this->dataMapper->map($this->dataLoader->load());
    }

    /**
     * @param int $offset
     * @param int $limit
     * @param null|string $filter
     * @return ArrayCollection
     */
    public function get(int $offset, int $limit, ?string $filter): array
    {
        $users = $this->loadData();

        if ($filter) {
            $users = $users->filter(
                function (User $entry) use ($filter) {
                    return strstr($entry->getLastname(), $filter)
                        || strstr($entry->getFirstname(), $filter)
                        || strstr($entry->getEmail(), $filter);
                }
            );
        }

        return array_values($users->slice($offset, $limit));
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function getByID(int $id): ?User
    {
        $users = $this->loadData();
        return $users->offsetGet($id - 1);
    }
}