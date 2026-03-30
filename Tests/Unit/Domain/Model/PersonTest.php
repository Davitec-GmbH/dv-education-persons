<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Tests\Unit\Domain\Model;

use Davitec\DvEducationPersons\Domain\Model\Link;
use Davitec\DvEducationPersons\Domain\Model\Person;
use Davitec\DvEducationPersons\Domain\Model\Publication;
use Davitec\DvEducationPersons\Domain\Model\Research;
use Davitec\DvEducationPersons\Domain\Model\Teaching;
use Davitec\DvEducationPersons\Domain\Model\VitaEntry;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Unit tests for Person domain model.
 */
class PersonTest extends UnitTestCase
{
    protected Person $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new Person();
        $this->subject->initializeObject();
    }

    // Model inheritance

    #[Test]
    public function testPersonExtendsAbstractEntity(): void
    {
        self::assertInstanceOf(AbstractEntity::class, $this->subject);
    }

    // initializeObject

    #[Test]
    public function testInitializeObjectInitializesImage(): void
    {
        $person = new Person();
        $person->initializeObject();
        self::assertInstanceOf(ObjectStorage::class, $person->getImage());
        self::assertCount(0, $person->getImage());
    }

    #[Test]
    public function testInitializeObjectInitializesVitaEntries(): void
    {
        $person = new Person();
        $person->initializeObject();
        self::assertInstanceOf(ObjectStorage::class, $person->getVitaEntries());
        self::assertCount(0, $person->getVitaEntries());
    }

    #[Test]
    public function testInitializeObjectInitializesPublications(): void
    {
        $person = new Person();
        $person->initializeObject();
        self::assertInstanceOf(ObjectStorage::class, $person->getPublications());
        self::assertCount(0, $person->getPublications());
    }

    #[Test]
    public function testInitializeObjectInitializesResearches(): void
    {
        $person = new Person();
        $person->initializeObject();
        self::assertInstanceOf(ObjectStorage::class, $person->getResearches());
        self::assertCount(0, $person->getResearches());
    }

    #[Test]
    public function testInitializeObjectInitializesTeachings(): void
    {
        $person = new Person();
        $person->initializeObject();
        self::assertInstanceOf(ObjectStorage::class, $person->getTeachings());
        self::assertCount(0, $person->getTeachings());
    }

    #[Test]
    public function testInitializeObjectInitializesPersonLinks(): void
    {
        $person = new Person();
        $person->initializeObject();
        self::assertInstanceOf(ObjectStorage::class, $person->getPersonLinks());
        self::assertCount(0, $person->getPersonLinks());
    }

    // Username

    #[Test]
    public function testGetUsernameReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getUsername());
    }

    #[Test]
    public function testSetUsernameSetsUsername(): void
    {
        $this->subject->setUsername('jdoe');
        self::assertSame('jdoe', $this->subject->getUsername());
    }

    // FirstName

    #[Test]
    public function testGetFirstNameReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getFirstName());
    }

    #[Test]
    public function testSetFirstNameSetsFirstName(): void
    {
        $this->subject->setFirstName('Max');
        self::assertSame('Max', $this->subject->getFirstName());
    }

    // LastName

    #[Test]
    public function testGetLastNameReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getLastName());
    }

    #[Test]
    public function testSetLastNameSetsLastName(): void
    {
        $this->subject->setLastName('Mustermann');
        self::assertSame('Mustermann', $this->subject->getLastName());
    }

    // getName()

    #[Test]
    public function testGetNameReturnsFullName(): void
    {
        $this->subject->setFirstName('Max');
        $this->subject->setLastName('Mustermann');
        self::assertSame('Max Mustermann', $this->subject->getName());
    }

    #[Test]
    public function testGetNameTrimsWhitespaceWhenFirstNameEmpty(): void
    {
        $this->subject->setLastName('Mustermann');
        self::assertSame('Mustermann', $this->subject->getName());
    }

    #[Test]
    public function testGetNameTrimsWhitespaceWhenLastNameEmpty(): void
    {
        $this->subject->setFirstName('Max');
        self::assertSame('Max', $this->subject->getName());
    }

    #[Test]
    public function testGetNameReturnsEmptyStringWhenBothEmpty(): void
    {
        self::assertSame('', $this->subject->getName());
    }

    // Email

    #[Test]
    public function testGetEmailReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getEmail());
    }

    #[Test]
    public function testSetEmailSetsEmail(): void
    {
        $this->subject->setEmail('max@example.com');
        self::assertSame('max@example.com', $this->subject->getEmail());
    }

    // Telephone

    #[Test]
    public function testGetTelephoneReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getTelephone());
    }

    #[Test]
    public function testSetTelephoneSetsTelephone(): void
    {
        $this->subject->setTelephone('+49 351 9876543');
        self::assertSame('+49 351 9876543', $this->subject->getTelephone());
    }

    // Www

    #[Test]
    public function testGetWwwReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getWww());
    }

    #[Test]
    public function testSetWwwSetsWww(): void
    {
        $this->subject->setWww('https://example.com');
        self::assertSame('https://example.com', $this->subject->getWww());
    }

    // Company

    #[Test]
    public function testGetCompanyReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getCompany());
    }

    #[Test]
    public function testSetCompanySetsCompany(): void
    {
        $this->subject->setCompany('Davitec GmbH');
        self::assertSame('Davitec GmbH', $this->subject->getCompany());
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
        $this->subject->setTitle('Prof. Dr.');
        self::assertSame('Prof. Dr.', $this->subject->getTitle());
    }

    // Image (ObjectStorage)

    #[Test]
    public function testGetImageReturnsObjectStorage(): void
    {
        self::assertInstanceOf(ObjectStorage::class, $this->subject->getImage());
    }

    #[Test]
    public function testSetImageSetsImage(): void
    {
        $storage = new ObjectStorage();
        $this->subject->setImage($storage);
        self::assertSame($storage, $this->subject->getImage());
    }

    #[Test]
    public function testGetImageReturnsNewObjectStorageWhenNull(): void
    {
        $person = new Person();
        self::assertInstanceOf(ObjectStorage::class, $person->getImage());
    }

    // Room

    #[Test]
    public function testGetRoomReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getRoom());
    }

    #[Test]
    public function testSetRoomSetsRoom(): void
    {
        $this->subject->setRoom('A123');
        self::assertSame('A123', $this->subject->getRoom());
    }

    // Department

    #[Test]
    public function testGetDepartmentReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getDepartment());
    }

    #[Test]
    public function testSetDepartmentSetsDepartment(): void
    {
        $this->subject->setDepartment('Informatik');
        self::assertSame('Informatik', $this->subject->getDepartment());
    }

    // Position

    #[Test]
    public function testGetPositionReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getPosition());
    }

    #[Test]
    public function testSetPositionSetsPosition(): void
    {
        $this->subject->setPosition('Professor');
        self::assertSame('Professor', $this->subject->getPosition());
    }

    // TeachingArea

    #[Test]
    public function testGetTeachingAreaReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getTeachingArea());
    }

    #[Test]
    public function testSetTeachingAreaSetsTeachingArea(): void
    {
        $this->subject->setTeachingArea('Mathematik');
        self::assertSame('Mathematik', $this->subject->getTeachingArea());
    }

    // ConsultationHours

    #[Test]
    public function testGetConsultationHoursReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getConsultationHours());
    }

    #[Test]
    public function testSetConsultationHoursSetsConsultationHours(): void
    {
        $this->subject->setConsultationHours('Mo 10-12 Uhr');
        self::assertSame('Mo 10-12 Uhr', $this->subject->getConsultationHours());
    }

    // Mobile

    #[Test]
    public function testGetMobileReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getMobile());
    }

    #[Test]
    public function testSetMobileSetsMobile(): void
    {
        $this->subject->setMobile('+49 171 1234567');
        self::assertSame('+49 171 1234567', $this->subject->getMobile());
    }

    // Fax

    #[Test]
    public function testGetFaxReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getFax());
    }

    #[Test]
    public function testSetFaxSetsFax(): void
    {
        $this->subject->setFax('+49 351 1234567');
        self::assertSame('+49 351 1234567', $this->subject->getFax());
    }

    // Slug

    #[Test]
    public function testGetSlugReturnsEmptyStringByDefault(): void
    {
        self::assertSame('', $this->subject->getSlug());
    }

    #[Test]
    public function testSetSlugSetsSlug(): void
    {
        $this->subject->setSlug('max-mustermann');
        self::assertSame('max-mustermann', $this->subject->getSlug());
    }

    // VitaEntries

    #[Test]
    public function testGetVitaEntriesReturnsObjectStorage(): void
    {
        self::assertInstanceOf(ObjectStorage::class, $this->subject->getVitaEntries());
    }

    #[Test]
    public function testSetVitaEntriesSetsVitaEntries(): void
    {
        $storage = new ObjectStorage();
        $entry = new VitaEntry();
        $storage->attach($entry);
        $this->subject->setVitaEntries($storage);
        self::assertCount(1, $this->subject->getVitaEntries());
        self::assertTrue($this->subject->getVitaEntries()->contains($entry));
    }

    #[Test]
    public function testAddVitaEntryAddsEntry(): void
    {
        $entry = new VitaEntry();
        $this->subject->addVitaEntry($entry);
        self::assertCount(1, $this->subject->getVitaEntries());
        self::assertTrue($this->subject->getVitaEntries()->contains($entry));
    }

    #[Test]
    public function testRemoveVitaEntryRemovesEntry(): void
    {
        $entry = new VitaEntry();
        $this->subject->addVitaEntry($entry);
        $this->subject->removeVitaEntry($entry);
        self::assertCount(0, $this->subject->getVitaEntries());
        self::assertFalse($this->subject->getVitaEntries()->contains($entry));
    }

    // Publications

    #[Test]
    public function testGetPublicationsReturnsObjectStorage(): void
    {
        self::assertInstanceOf(ObjectStorage::class, $this->subject->getPublications());
    }

    #[Test]
    public function testSetPublicationsSetsPublications(): void
    {
        $storage = new ObjectStorage();
        $publication = new Publication();
        $storage->attach($publication);
        $this->subject->setPublications($storage);
        self::assertCount(1, $this->subject->getPublications());
        self::assertTrue($this->subject->getPublications()->contains($publication));
    }

    #[Test]
    public function testAddPublicationAddsPublication(): void
    {
        $publication = new Publication();
        $this->subject->addPublication($publication);
        self::assertCount(1, $this->subject->getPublications());
        self::assertTrue($this->subject->getPublications()->contains($publication));
    }

    #[Test]
    public function testRemovePublicationRemovesPublication(): void
    {
        $publication = new Publication();
        $this->subject->addPublication($publication);
        $this->subject->removePublication($publication);
        self::assertCount(0, $this->subject->getPublications());
        self::assertFalse($this->subject->getPublications()->contains($publication));
    }

    // Researches

    #[Test]
    public function testGetResearchesReturnsObjectStorage(): void
    {
        self::assertInstanceOf(ObjectStorage::class, $this->subject->getResearches());
    }

    #[Test]
    public function testSetResearchesSetsResearches(): void
    {
        $storage = new ObjectStorage();
        $research = new Research();
        $storage->attach($research);
        $this->subject->setResearches($storage);
        self::assertCount(1, $this->subject->getResearches());
        self::assertTrue($this->subject->getResearches()->contains($research));
    }

    #[Test]
    public function testAddResearchAddsResearch(): void
    {
        $research = new Research();
        $this->subject->addResearch($research);
        self::assertCount(1, $this->subject->getResearches());
        self::assertTrue($this->subject->getResearches()->contains($research));
    }

    #[Test]
    public function testRemoveResearchRemovesResearch(): void
    {
        $research = new Research();
        $this->subject->addResearch($research);
        $this->subject->removeResearch($research);
        self::assertCount(0, $this->subject->getResearches());
        self::assertFalse($this->subject->getResearches()->contains($research));
    }

    // Teachings

    #[Test]
    public function testGetTeachingsReturnsObjectStorage(): void
    {
        self::assertInstanceOf(ObjectStorage::class, $this->subject->getTeachings());
    }

    #[Test]
    public function testSetTeachingsSetsTeachings(): void
    {
        $storage = new ObjectStorage();
        $teaching = new Teaching();
        $storage->attach($teaching);
        $this->subject->setTeachings($storage);
        self::assertCount(1, $this->subject->getTeachings());
        self::assertTrue($this->subject->getTeachings()->contains($teaching));
    }

    #[Test]
    public function testAddTeachingAddsTeaching(): void
    {
        $teaching = new Teaching();
        $this->subject->addTeaching($teaching);
        self::assertCount(1, $this->subject->getTeachings());
        self::assertTrue($this->subject->getTeachings()->contains($teaching));
    }

    #[Test]
    public function testRemoveTeachingRemovesTeaching(): void
    {
        $teaching = new Teaching();
        $this->subject->addTeaching($teaching);
        $this->subject->removeTeaching($teaching);
        self::assertCount(0, $this->subject->getTeachings());
        self::assertFalse($this->subject->getTeachings()->contains($teaching));
    }

    // PersonLinks

    #[Test]
    public function testGetPersonLinksReturnsObjectStorage(): void
    {
        self::assertInstanceOf(ObjectStorage::class, $this->subject->getPersonLinks());
    }

    #[Test]
    public function testSetPersonLinksSetsPersonLinks(): void
    {
        $storage = new ObjectStorage();
        $link = new Link();
        $storage->attach($link);
        $this->subject->setPersonLinks($storage);
        self::assertCount(1, $this->subject->getPersonLinks());
        self::assertTrue($this->subject->getPersonLinks()->contains($link));
    }

    #[Test]
    public function testAddPersonLinkAddsLink(): void
    {
        $link = new Link();
        $this->subject->addPersonLink($link);
        self::assertCount(1, $this->subject->getPersonLinks());
        self::assertTrue($this->subject->getPersonLinks()->contains($link));
    }

    #[Test]
    public function testRemovePersonLinkRemovesLink(): void
    {
        $link = new Link();
        $this->subject->addPersonLink($link);
        $this->subject->removePersonLink($link);
        self::assertCount(0, $this->subject->getPersonLinks());
        self::assertFalse($this->subject->getPersonLinks()->contains($link));
    }

    // Edge cases: getters return new ObjectStorage when property is null (before initializeObject)

    #[Test]
    public function testGetVitaEntriesReturnsNewObjectStorageWhenNull(): void
    {
        $person = new Person();
        self::assertInstanceOf(ObjectStorage::class, $person->getVitaEntries());
    }

    #[Test]
    public function testGetPublicationsReturnsNewObjectStorageWhenNull(): void
    {
        $person = new Person();
        self::assertInstanceOf(ObjectStorage::class, $person->getPublications());
    }

    #[Test]
    public function testGetResearchesReturnsNewObjectStorageWhenNull(): void
    {
        $person = new Person();
        self::assertInstanceOf(ObjectStorage::class, $person->getResearches());
    }

    #[Test]
    public function testGetTeachingsReturnsNewObjectStorageWhenNull(): void
    {
        $person = new Person();
        self::assertInstanceOf(ObjectStorage::class, $person->getTeachings());
    }

    #[Test]
    public function testGetPersonLinksReturnsNewObjectStorageWhenNull(): void
    {
        $person = new Person();
        self::assertInstanceOf(ObjectStorage::class, $person->getPersonLinks());
    }
}
