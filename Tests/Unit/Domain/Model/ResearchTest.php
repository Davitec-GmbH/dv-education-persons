<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Tests\Unit\Domain\Model;

use Davitec\DvEducationPersons\Domain\Model\Research;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Unit tests for Research domain model.
 */
class ResearchTest extends UnitTestCase
{
    protected Research $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new Research();
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
        $this->subject->setTitle('AI in Healthcare');
        self::assertSame('AI in Healthcare', $this->subject->getTitle());
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
        $this->subject->setDescription('Research on AI applications');
        self::assertSame('Research on AI applications', $this->subject->getDescription());
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
        $date = new \DateTime('2025-03-01');
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
        $this->subject->setUrl('https://example.com/research');
        self::assertSame('https://example.com/research', $this->subject->getUrl());
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
        $this->subject->setSorting(10);
        self::assertSame(10, $this->subject->getSorting());
    }
}
