<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Tests\Unit\Domain\Model;

use Davitec\DvEducationPersons\Domain\Model\Link;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Unit tests for Link domain model.
 */
class LinkTest extends UnitTestCase
{
    protected Link $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new Link();
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
        $this->subject->setTitle('Homepage');
        self::assertSame('Homepage', $this->subject->getTitle());
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
        $this->subject->setUrl('https://example.com');
        self::assertSame('https://example.com', $this->subject->getUrl());
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
        $this->subject->setSorting(7);
        self::assertSame(7, $this->subject->getSorting());
    }
}
