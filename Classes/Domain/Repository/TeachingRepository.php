<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for Teaching domain model.
 */
class TeachingRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting' => QueryInterface::ORDER_ASCENDING,
    ];

    /**
     * Find all teaching entries belonging to a specific person.
     *
     * @param int $personUid The UID of the person
     * @return QueryResultInterface<\Davitec\DvEducationPersons\Domain\Model\Teaching>
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
