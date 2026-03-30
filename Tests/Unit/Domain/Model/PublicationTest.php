<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Tests\Unit\Domain\Model;

use Davitec\DvEducationPersons\Domain\Model\Publication;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Unit tests for Publication domain model.
 */
class PublicationTest extends UnitTestCase
{
    protected Publication $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new Publication();
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
        $this->subject->setTitle('Machine Learning in Education');
        self::assertSame('Machine Learning in Education', $this->subject->getTitle());
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
        $this->subject->setDescription('A comprehensive study');
        self::assertSame('A comprehensive study', $this->subject->getDescription());
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
        $date = new \DateTime('2024-06-15');
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
        $this->subject->setUrl('https://example.com/publication');
        self::assertSame('https://example.com/publication', $this->subject->getUrl());
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
        $this->subject->setSorting(5);
        self::assertSame(5, $this->subject->getSorting());
    }
}
