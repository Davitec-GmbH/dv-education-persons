<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Tests\Functional\Repository;

use Davitec\DvEducationPersons\Domain\Model\Person;
use Davitec\DvEducationPersons\Domain\Repository\PersonRepository;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Functional tests for the PersonRepository.
 *
 * Verifies querying, filtering, and ordering of Person records
 * stored in the fe_users table via Extbase persistence.
 */
class PersonRepositoryTest extends FunctionalTestCase
{
    /** @var array<int, string> */
    protected array $testExtensionsToLoad = [
        'typo3conf/ext/dv_education_persons',
    ];

    private PersonRepository $subject;

    /**
     * Set up test environment and import CSV fixtures.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet(__DIR__ . '/../Fixtures/pages.csv');
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/fe_groups.csv');
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/fe_users.csv');

        $this->subject = $this->get(PersonRepository::class);

        // Remove default storage page restriction so all records are found.
        $querySettings = $this->subject->createQuery()->getQuerySettings();
        $querySettings->setRespectStoragePage(false);
        $this->subject->setDefaultQuerySettings($querySettings);
    }

    /**
     * Verify that findAll returns all non-disabled, non-deleted persons
     * and that results are ordered by last_name ASC, first_name ASC.
     */
    #[Test]
    public function testFindAllReturnsAllPersons(): void
    {
        $result = $this->subject->findAll();

        // 4 active persons (uid 5 is disabled)
        self::assertCount(4, $result);

        $names = [];
        foreach ($result as $person) {
            self::assertInstanceOf(Person::class, $person);
            $names[] = $person->getLastName();
        }

        // Expected order: Braun, Müller, Schmidt, Weber
        self::assertSame(['Braun', 'Müller', 'Schmidt', 'Weber'], $names);
    }

    /**
     * Verify that findBySearchTerm matches partial first or last names.
     */
    #[Test]
    public function testFindBySearchTermFindsMatchingPersons(): void
    {
        $result = $this->subject->findBySearchTerm('Schmi');

        self::assertCount(1, $result);

        $person = $result->getFirst();
        self::assertInstanceOf(Person::class, $person);
        self::assertSame('Schmidt', $person->getLastName());
    }

    /**
     * Verify that findBySearchTerm also searches the department field.
     */
    #[Test]
    public function testFindBySearchTermSearchesDepartment(): void
    {
        $result = $this->subject->findBySearchTerm('Wirtschaft');

        self::assertCount(1, $result);

        $person = $result->getFirst();
        self::assertInstanceOf(Person::class, $person);
        self::assertSame('Müller', $person->getLastName());
    }

    /**
     * Verify that findByDepartment returns only persons of that department.
     */
    #[Test]
    public function testFindByDepartmentReturnsOnlyMatchingPersons(): void
    {
        $result = $this->subject->findByDepartment('Informatik');

        // Maria Schmidt + Sarah Braun (uid 5 is disabled)
        self::assertCount(2, $result);

        $lastNames = [];
        foreach ($result as $person) {
            $lastNames[] = $person->getLastName();
        }

        // Default ordering: last_name ASC
        self::assertSame(['Braun', 'Schmidt'], $lastNames);
    }

    /**
     * Verify that findByDepartment returns an empty result for a non-existent department.
     */
    #[Test]
    public function testFindByDepartmentReturnsEmptyForUnknownDepartment(): void
    {
        $result = $this->subject->findByDepartment('Philosophie');

        self::assertCount(0, $result);
    }

    /**
     * Verify that findByFirstLetter returns persons whose last name starts with the given letter.
     */
    #[Test]
    public function testFindByFirstLetterReturnsMatchingPersons(): void
    {
        $result = $this->subject->findByFirstLetter('S');

        self::assertCount(1, $result);

        $person = $result->getFirst();
        self::assertInstanceOf(Person::class, $person);
        self::assertSame('Schmidt', $person->getLastName());
    }

    /**
     * Verify that findByFirstLetter is case-insensitive (lowercase 's' also matches 'Schmidt').
     *
     * Note: This depends on the database collation. MySQL/MariaDB with default
     * utf8_general_ci collation treats LIKE as case-insensitive. SQLite used by
     * the testing framework may behave differently for non-ASCII characters.
     */
    #[Test]
    public function testFindByFirstLetterIsCaseInsensitive(): void
    {
        $result = $this->subject->findByFirstLetter('s');

        // With case-insensitive collation, 's%' matches 'Schmidt'
        self::assertCount(1, $result);

        $person = $result->getFirst();
        self::assertInstanceOf(Person::class, $person);
        self::assertSame('Schmidt', $person->getLastName());
    }

    /**
     * Verify that findDistinctDepartments returns a sorted unique list of departments.
     */
    #[Test]
    public function testFindDistinctDepartmentsReturnsSortedUniqueList(): void
    {
        $departments = $this->subject->findDistinctDepartments();

        // Gestaltung, Informatik, Wirtschaft (uid 5 is disabled, excluded)
        self::assertSame(['Gestaltung', 'Informatik', 'Wirtschaft'], $departments);
    }
}
