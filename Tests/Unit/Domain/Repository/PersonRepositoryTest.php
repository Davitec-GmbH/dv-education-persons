<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Tests\Unit\Domain\Repository;

use Davitec\DvEducationPersons\Domain\Repository\PersonRepository;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Expression\ExpressionBuilder;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Unit tests for PersonRepository.
 */
class PersonRepositoryTest extends UnitTestCase
{
    #[Test]
    public function testDefaultOrderingsAreSetCorrectly(): void
    {
        $connectionPool = $this->createMock(ConnectionPool::class);

        $subject = $this->getAccessibleMock(
            PersonRepository::class,
            [],
            [$connectionPool],
        );

        $defaultOrderings = $subject->_get('defaultOrderings');

        self::assertSame(
            [
                'last_name' => QueryInterface::ORDER_ASCENDING,
                'first_name' => QueryInterface::ORDER_ASCENDING,
            ],
            $defaultOrderings
        );
    }

    #[Test]
    public function testFindDistinctDepartmentsReturnsArrayOfStrings(): void
    {
        $expressionBuilder = $this->createMock(ExpressionBuilder::class);
        $expressionBuilder->method('neq')->willReturn('department != \'\'');
        $expressionBuilder->method('eq')->willReturn('1 = 1');

        $statement = $this->createMock(\Doctrine\DBAL\Result::class);
        $statement->method('fetchAssociative')->willReturnOnConsecutiveCalls(
            ['department' => 'Informatik'],
            ['department' => 'Mathematik'],
            false,
        );

        $queryBuilder = $this->createMock(QueryBuilder::class);
        $queryBuilder->method('select')->willReturnSelf();
        $queryBuilder->method('from')->willReturnSelf();
        $queryBuilder->method('where')->willReturnSelf();
        $queryBuilder->method('groupBy')->willReturnSelf();
        $queryBuilder->method('orderBy')->willReturnSelf();
        $queryBuilder->method('expr')->willReturn($expressionBuilder);
        $queryBuilder->method('createNamedParameter')->willReturn('\'\'');
        $queryBuilder->method('executeQuery')->willReturn($statement);

        $connectionPool = $this->createMock(ConnectionPool::class);
        $connectionPool->method('getQueryBuilderForTable')
            ->with('fe_users')
            ->willReturn($queryBuilder);

        $subject = $this->getAccessibleMock(
            PersonRepository::class,
            [],
            [$connectionPool],
        );

        $result = $subject->findDistinctDepartments();

        self::assertSame(['Informatik', 'Mathematik'], $result);
    }

    #[Test]
    public function testFindDistinctDepartmentsReturnsEmptyArrayWhenNoDepartments(): void
    {
        $expressionBuilder = $this->createMock(ExpressionBuilder::class);
        $expressionBuilder->method('neq')->willReturn('department != \'\'');
        $expressionBuilder->method('eq')->willReturn('1 = 1');

        $statement = $this->createMock(\Doctrine\DBAL\Result::class);
        $statement->method('fetchAssociative')->willReturn(false);

        $queryBuilder = $this->createMock(QueryBuilder::class);
        $queryBuilder->method('select')->willReturnSelf();
        $queryBuilder->method('from')->willReturnSelf();
        $queryBuilder->method('where')->willReturnSelf();
        $queryBuilder->method('groupBy')->willReturnSelf();
        $queryBuilder->method('orderBy')->willReturnSelf();
        $queryBuilder->method('expr')->willReturn($expressionBuilder);
        $queryBuilder->method('createNamedParameter')->willReturn('\'\'');
        $queryBuilder->method('executeQuery')->willReturn($statement);

        $connectionPool = $this->createMock(ConnectionPool::class);
        $connectionPool->method('getQueryBuilderForTable')
            ->with('fe_users')
            ->willReturn($queryBuilder);

        $subject = $this->getAccessibleMock(
            PersonRepository::class,
            [],
            [$connectionPool],
        );

        $result = $subject->findDistinctDepartments();

        self::assertSame([], $result);
    }
}
