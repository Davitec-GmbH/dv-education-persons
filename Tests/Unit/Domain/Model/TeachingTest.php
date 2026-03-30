<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Tests\Unit\Domain\Model;

use Davitec\DvEducationPersons\Domain\Model\Teaching;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Unit tests for Teaching domain model.
 */
class TeachingTest extends UnitTestCase
{
    protected Teaching $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new Teaching();
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
        $this->subject->setTitle('Grundlagen der Informatik');
        self::assertSame('Grundlagen der Informatik', $this->subject->getTitle());
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
        $this->subject->setDescription('Vorlesung im Wintersemester');
        self::assertSame('Vorlesung im Wintersemester', $this->subject->getDescription());
    }

    // Date

    #[Test]
    public function testGetDateReturnsNullByDefault(): void
    {
        self::assertNull($this->subject->getDate());
    }

    #[Test]
    public function testSetDateSetsDate(): void
    {
        $date = new \DateTime('2025-10-01');
        $this->subject->setDate($date);
        self::assertSame($date, $this->subject->getDate());
    }

    #[Test]
    public function testSetDateAcceptsNull(): void
    {
        $this->subject->setDate(new \DateTime());
        $this->subject->setDate(null);
        self::assertNull($this->subject->getDate());
    }

    // Url

    #[Test]
    public function testGetUrlReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getUrl());
    }

    #[Test]
    public function testSetUrlSetsUrl(): void
    {
        $this->subject->setUrl('https://example.com/teaching');
        self::assertSame('https://example.com/teaching', $this->subject->getUrl());
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
        $this->subject->setSorting(3);
        self::assertSame(3, $this->subject->getSorting());
    }
}
