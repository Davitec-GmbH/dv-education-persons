<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Tests\Functional\Repository;

use Davitec\DvEducationPersons\Domain\Model\Publication;
use Davitec\DvEducationPersons\Domain\Model\VitaEntry;
use Davitec\DvEducationPersons\Domain\Repository\PublicationRepository;
use Davitec\DvEducationPersons\Domain\Repository\VitaEntryRepository;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Functional tests for sub-entity repositories (VitaEntry, Publication).
 *
 * Verifies that findByPerson returns the correct records
 * in the expected order (sorted by the sorting field).
 */
class SubEntityRepositoryTest extends FunctionalTestCase
{
    /** @var array<int, string> */
    protected array $testExtensionsToLoad = [
        'typo3conf/ext/dv_education_persons',
    ];

    private VitaEntryRepository $vitaEntryRepository;

    private PublicationRepository $publicationRepository;

    /**
     * Set up test environment and import CSV fixtures.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet(__DIR__ . '/../Fixtures/pages.csv');
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/fe_groups.csv');
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/fe_users.csv');
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/tx_dveducationpersons_domain_model_vitaentry.csv');
        $this->importCSVDataSet(__DIR__ . '/../Fixtures/tx_dveducationpersons_domain_model_publication.csv');

        $this->vitaEntryRepository = $this->get(VitaEntryRepository::class);
        $this->publicationRepository = $this->get(PublicationRepository::class);

        // Remove storage page restriction for vita entries.
        $vitaQuerySettings = $this->vitaEntryRepository->createQuery()->getQuerySettings();
        $vitaQuerySettings->setRespectStoragePage(false);
        $this->vitaEntryRepository->setDefaultQuerySettings($vitaQuerySettings);

        // Remove storage page restriction for publications.
        $pubQuerySettings = $this->publicationRepository->createQuery()->getQuerySettings();
        $pubQuerySettings->setRespectStoragePage(false);
        $this->publicationRepository->setDefaultQuerySettings($pubQuerySettings);
    }

    /**
     * Verify that VitaEntryRepository::findByPerson returns the correct entries
     * for a given person, sorted by the sorting field in ascending order.
     */
    #[Test]
    public function testFindByPersonReturnsVitaEntriesSorted(): void
    {
        $result = $this->vitaEntryRepository->findByPerson(1);

        self::assertCount(2, $result);

        $titles = [];
        foreach ($result as $entry) {
            self::assertInstanceOf(VitaEntry::class, $entry);
            $titles[] = $entry->getTitle();
        }

        // sorting 1 = "Prof Position", sorting 2 = "Senior Dev"
        self::assertSame(['Prof Position', 'Senior Dev'], $titles);
    }

    /**
     * Verify that VitaEntryRepository::findByPerson returns an empty result
     * for a person that has no vita entries.
     */
    #[Test]
    public function testFindByPersonReturnsEmptyForPersonWithoutVitaEntries(): void
    {
        // Person uid 2 (Thomas Müller) has no vita entries in the fixture
        $result = $this->vitaEntryRepository->findByPerson(2);

        self::assertCount(0, $result);
    }

    /**
     * Verify that PublicationRepository::findByPerson returns the correct publications
     * for a given person.
     */
    #[Test]
    public function testFindByPersonReturnsPublications(): void
    {
        $result = $this->publicationRepository->findByPerson(1);

        self::assertCount(1, $result);

        $publication = $result->getFirst();
        self::assertInstanceOf(Publication::class, $publication);
        self::assertSame('Paper A', $publication->getTitle());
        self::assertSame('Journal X', $publication->getDescription());
    }

    /**
     * Verify that PublicationRepository::findByPerson returns an empty result
     * for a person that has no publications.
     */
    #[Test]
    public function testFindByPersonReturnsEmptyForPersonWithoutPublications(): void
    {
        // Person uid 3 (Lisa Weber) has no publications in the fixture
        $result = $this->publicationRepository->findByPerson(3);

        self::assertCount(0, $result);
    }
}
