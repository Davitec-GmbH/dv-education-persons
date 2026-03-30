<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Tests\Unit\Controller;

use Davitec\DvEducationPersons\Controller\PersonEditController;
use Davitec\DvEducationPersons\Domain\Model\Person;
use Davitec\DvEducationPersons\Domain\Repository\PersonRepository;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Unit tests for PersonEditController.
 */
class PersonEditControllerTest extends UnitTestCase
{
    protected PersonEditController&MockObject $subject;
    protected PersonRepository&MockObject $personRepository;
    protected Context&MockObject $context;
    protected PersistenceManager&MockObject $persistenceManager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->personRepository = $this->createMock(PersonRepository::class);
        $this->context = $this->createMock(Context::class);
        $this->persistenceManager = $this->createMock(PersistenceManager::class);

        $this->subject = $this->getAccessibleMock(
            PersonEditController::class,
            ['htmlResponse', 'redirect', 'addFlashMessage'],
            [$this->personRepository, $this->context, $this->persistenceManager],
        );
    }

    #[Test]
    public function testGetLoggedInFeUserIdReturnsZeroWhenNoUserLoggedIn(): void
    {
        $this->context
            ->method('getPropertyFromAspect')
            ->with('frontend.user', 'id')
            ->willReturn(0);

        $result = $this->subject->_call('getLoggedInFeUserId');

        self::assertSame(0, $result);
    }

    #[Test]
    public function testGetLoggedInFeUserIdReturnsUserUid(): void
    {
        $this->context
            ->method('getPropertyFromAspect')
            ->with('frontend.user', 'id')
            ->willReturn(42);

        $result = $this->subject->_call('getLoggedInFeUserId');

        self::assertSame(42, $result);
    }

    #[Test]
    public function testEditActionReturnsResponseWhenNoUserLoggedIn(): void
    {
        $this->context
            ->method('getPropertyFromAspect')
            ->with('frontend.user', 'id')
            ->willReturn(0);

        $response = $this->createMock(ResponseInterface::class);
        $this->subject
            ->method('htmlResponse')
            ->willReturn($response);

        $this->subject
            ->expects(self::once())
            ->method('addFlashMessage')
            ->with(
                'Sie müssen eingeloggt sein, um Ihr Profil bearbeiten zu können.',
                'Kein Zugriff',
                self::anything(),
            );

        $result = $this->subject->editAction();

        self::assertSame($response, $result);
    }

    #[Test]
    public function testUpdateActionRejectsWhenPersonUidDoesNotMatchLoggedInUser(): void
    {
        $this->context
            ->method('getPropertyFromAspect')
            ->with('frontend.user', 'id')
            ->willReturn(42);

        $person = $this->createMock(Person::class);
        $person->method('getUid')->willReturn(99);

        $redirectResponse = $this->createMock(ResponseInterface::class);
        $this->subject
            ->method('redirect')
            ->with('edit')
            ->willReturn($redirectResponse);

        $this->subject
            ->expects(self::once())
            ->method('addFlashMessage')
            ->with(
                'Sie sind nicht berechtigt, dieses Profil zu bearbeiten.',
                'Zugriff verweigert',
                self::anything(),
            );

        $result = $this->subject->updateAction($person);

        self::assertSame($redirectResponse, $result);
    }

    #[Test]
    public function testUpdateActionRejectsWhenNoUserLoggedIn(): void
    {
        $this->context
            ->method('getPropertyFromAspect')
            ->with('frontend.user', 'id')
            ->willReturn(0);

        $person = $this->createMock(Person::class);
        $person->method('getUid')->willReturn(5);

        $redirectResponse = $this->createMock(ResponseInterface::class);
        $this->subject
            ->method('redirect')
            ->with('edit')
            ->willReturn($redirectResponse);

        $result = $this->subject->updateAction($person);

        self::assertSame($redirectResponse, $result);
    }
}
