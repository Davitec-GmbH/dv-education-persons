<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Domain\Repository;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for Person domain model.
 */
class PersonRepository extends Repository
{
    protected array $defaultOrderings = [
        'last_name' => QueryInterface::ORDER_ASCENDING,
        'first_name' => QueryInterface::ORDER_ASCENDING,
    ];

    public function __construct(
        private readonly ConnectionPool $connectionPool,
    ) {
        parent::__construct();
    }

    /**
     * Returns a sorted list of distinct department names from all person records.
     *
     * @return string[]
     */
    public function findDistinctDepartments(): array
    {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('fe_users');
        $result = $queryBuilder
            ->select('department')
            ->from('fe_users')
            ->where(
                $queryBuilder->expr()->neq('department', $queryBuilder->createNamedParameter('')),
                $queryBuilder->expr()->eq('tx_extbase_type', $queryBuilder->createNamedParameter('Davitec\\DvEducationPersons\\Domain\\Model\\Person')),
                $queryBuilder->expr()->eq('deleted', 0),
                $queryBuilder->expr()->eq('disable', 0),
            )
            ->groupBy('department')
            ->orderBy('department', 'ASC')
            ->executeQuery();

        $departments = [];
        while ($row = $result->fetchAssociative()) {
            $departments[] = $row['department'];
        }

        return $departments;
    }

    /**
     * Find persons matching a search term across multiple fields.
     *
     * Searches in first_name, last_name, position, department and teaching_area.
     *
     * @param string $searchTerm The term to search for
     * @return QueryResultInterface<\Davitec\DvEducationPersons\Domain\Model\Person>
     */
    public function findBySearchTerm(string $searchTerm): QueryResultInterface
    {
        $query = $this->createQuery();
        $searchPattern = '%' . $searchTerm . '%';

        $query->matching(
            $query->logicalOr(
                $query->like('firstName', $searchPattern),
                $query->like('lastName', $searchPattern),
                $query->like('position', $searchPattern),
                $query->like('department', $searchPattern),
                $query->like('teachingArea', $searchPattern),
            )
        );

        return $query->execute();
    }

    /**
     * Find persons belonging to a specific department.
     *
     * @param string $department The department name
     * @return QueryResultInterface<\Davitec\DvEducationPersons\Domain\Model\Person>
     */
    public function findByDepartment(string $department): QueryResultInterface
    {
        $query = $this->createQuery();

        $query->matching(
            $query->equals('department', $department)
        );

        return $query->execute();
    }

    /**
     * Find persons whose last name starts with a given letter.
     *
     * @param string $letter The first letter to filter by
     * @return QueryResultInterface<\Davitec\DvEducationPersons\Domain\Model\Person>
     */
    public function findByFirstLetter(string $letter): QueryResultInterface
    {
        $query = $this->createQuery();

        $query->matching(
            $query->like('lastName', $letter . '%')
        );

        return $query->execute();
    }
}
