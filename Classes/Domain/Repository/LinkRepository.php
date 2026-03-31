<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for Link domain model.
 */
class LinkRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting' => QueryInterface::ORDER_ASCENDING,
    ];

    /**
     * Find all links belonging to a specific person.
     *
     * @param int $personUid The UID of the person
     * @return QueryResultInterface<\Davitec\DvEducationPersons\Domain\Model\Link>
     */
    public function findByPerson(int $personUid): QueryResultInterface
    {
        $query = $this->createQuery();

        $query->matching(
            $query->equals('person', $personUid)
        );

        return $query->execute();
    }
}
