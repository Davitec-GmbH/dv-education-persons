<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Tests\Unit\Domain\Model;

use Davitec\DvEducationPersons\Domain\Model\VitaEntry;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Unit tests for VitaEntry domain model.
 */
class VitaEntryTest extends UnitTestCase
{
    protected VitaEntry $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new VitaEntry();
    }

    // Title

    #[Test]
    public function testGetTitleReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getTitle());
    }

    #[Test]
    public function testSetTitleSetsTitle(): void
    {
        $this->subject->setTitle('Studium Informatik');
        self::assertSame('Studium Informatik', $this->subject->getTitle());
    }

    // Description

    #[Test]
    public function testGetDescriptionReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getDescription());
    }

    #[Test]
    public function testSetDescriptionSetsDescription(): void
    {
        $this->subject->setDescription('An der TU Dresden');
        self::assertSame('An der TU Dresden', $this->subject->getDescription());
    }

    // DateStart

    #[Test]
    public function testGetDateStartReturnsNullByDefault(): void
    {
        self::assertNull($this->subject->getDateStart());
    }

    #[Test]
    public function testSetDateStartSetsDateStart(): void
    {
        $date = new \DateTime('2020-01-01');
        $this->subject->setDateStart($date);
        self::assertSame($date, $this->subject->getDateStart());
    }

    #[Test]
    public function testSetDateStartAcceptsNull(): void
    {
        $this->subject->setDateStart(new \DateTime());
        $this->subject->setDateStart(null);
        self::assertNull($this->subject->getDateStart());
    }

    // DateEnd

    #[Test]
    public function testGetDateEndReturnsNullByDefault(): void
    {
        self::assertNull($this->subject->getDateEnd());
    }

    #[Test]
    public function testSetDateEndSetsDateEnd(): void
    {
        $date = new \DateTime('2024-12-31');
        $this->subject->setDateEnd($date);
        self::assertSame($date, $this->subject->getDateEnd());
    }

    #[Test]
    public function testSetDateEndAcceptsNull(): void
    {
        $this->subject->setDateEnd(new \DateTime());
        $this->subject->setDateEnd(null);
        self::assertNull($this->subject->getDateEnd());
    }

    // Sorting

    #[Test]
    public function testGetSortingReturnsZeroByDefault(): void
    {
        self::assertSame(0, $this->subject->getSorting());
    }

    #[Test]
    public function testSetSortingSetsSorting(): void
    {
        $this->subject->setSorting(42);
        self::assertSame(42, $this->subject->getSorting());
    }
}
