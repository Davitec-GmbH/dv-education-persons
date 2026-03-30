<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Domain model for a person (mapped to fe_users).
 */
class Person extends AbstractEntity
{
    // Core fe_users fields
    protected string $username = '';
    protected string $firstName = '';
    protected string $lastName = '';
    protected string $email = '';
    protected string $telephone = '';
    protected string $www = '';
    protected string $company = '';
    protected string $title = '';
    protected ?ObjectStorage $image = null;

    // Extension-specific fields
    protected string $room = '';

    protected string $department = '';

    protected string $position = '';

    protected string $teachingArea = '';

    protected string $consultationHours = '';

    protected string $mobile = '';

    protected string $fax = '';

    protected string $slug = '';

    /**
     * @var ObjectStorage<VitaEntry>|null
     */
    #[Lazy]
    #[Cascade(['value' => 'remove'])]
    protected ?ObjectStorage $vitaEntries = null;

    /**
     * @var ObjectStorage<Publication>|null
     */
    #[Lazy]
    #[Cascade(['value' => 'remove'])]
    protected ?ObjectStorage $publications = null;

    /**
     * @var ObjectStorage<Research>|null
     */
    #[Lazy]
    #[Cascade(['value' => 'remove'])]
    protected ?ObjectStorage $researches = null;

    /**
     * @var ObjectStorage<Teaching>|null
     */
    #[Lazy]
    #[Cascade(['value' => 'remove'])]
    protected ?ObjectStorage $teachings = null;

    /**
     * @var ObjectStorage<Link>|null
     */
    #[Lazy]
    #[Cascade(['value' => 'remove'])]
    protected ?ObjectStorage $personLinks = null;

    /**
     * Initialize all ObjectStorage properties.
     */
    public function initializeObject(): void
    {
        $this->image = new ObjectStorage();
        $this->vitaEntries = new ObjectStorage();
        $this->publications = new ObjectStorage();
        $this->researches = new ObjectStorage();
        $this->teachings = new ObjectStorage();
        $this->personLinks = new ObjectStorage();
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the full name (first + last).
     */
    public function getName(): string
    {
        return trim($this->firstName . ' ' . $this->lastName);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getWww(): string
    {
        return $this->www;
    }

    public function setWww(string $www): void
    {
        $this->www = $www;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getImage(): ObjectStorage
    {
        return $this->image ?? new ObjectStorage();
    }

    /**
     * @param ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $image
     */
    public function setImage(ObjectStorage $image): void
    {
        $this->image = $image;
    }

    /**
     * Returns the room.
     */
    public function getRoom(): string
    {
        return $this->room;
    }

    /**
     * Sets the room.
     */
    public function setRoom(string $room): void
    {
        $this->room = $room;
    }

    /**
     * Returns the department.
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * Sets the department.
     */
    public function setDepartment(string $department): void
    {
        $this->department = $department;
    }

    /**
     * Returns the position.
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * Sets the position.
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * Returns the teaching area.
     */
    public function getTeachingArea(): string
    {
        return $this->teachingArea;
    }

    /**
     * Sets the teaching area.
     */
    public function setTeachingArea(string $teachingArea): void
    {
        $this->teachingArea = $teachingArea;
    }

    /**
     * Returns the consultation hours.
     */
    public function getConsultationHours(): string
    {
        return $this->consultationHours;
    }

    /**
     * Sets the consultation hours.
     */
    public function setConsultationHours(string $consultationHours): void
    {
        $this->consultationHours = $consultationHours;
    }

    /**
     * Returns the mobile number.
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * Sets the mobile number.
     */
    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    /**
     * Returns the fax number.
     */
    public function getFax(): string
    {
        return $this->fax;
    }

    /**
     * Sets the fax number.
     */
    public function setFax(string $fax): void
    {
        $this->fax = $fax;
    }

    /**
     * Returns the slug.
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Sets the slug.
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * Returns the vita entries.
     *
     * @return ObjectStorage<VitaEntry>
     */
    public function getVitaEntries(): ObjectStorage
    {
        return $this->vitaEntries ?? new ObjectStorage();
    }

    /**
     * Sets the vita entries.
     *
     * @param ObjectStorage<VitaEntry> $vitaEntries
     */
    public function setVitaEntries(ObjectStorage $vitaEntries): void
    {
        $this->vitaEntries = $vitaEntries;
    }

    /**
     * Adds a vita entry.
     */
    public function addVitaEntry(VitaEntry $vitaEntry): void
    {
        $this->vitaEntries?->attach($vitaEntry);
    }

    /**
     * Removes a vita entry.
     */
    public function removeVitaEntry(VitaEntry $vitaEntry): void
    {
        $this->vitaEntries?->detach($vitaEntry);
    }

    /**
     * Returns the publications.
     *
     * @return ObjectStorage<Publication>
     */
    public function getPublications(): ObjectStorage
    {
        return $this->publications ?? new ObjectStorage();
    }

    /**
     * Sets the publications.
     *
     * @param ObjectStorage<Publication> $publications
     */
    public function setPublications(ObjectStorage $publications): void
    {
        $this->publications = $publications;
    }

    /**
     * Adds a publication.
     */
    public function addPublication(Publication $publication): void
    {
        $this->publications?->attach($publication);
    }

    /**
     * Removes a publication.
     */
    public function removePublication(Publication $publication): void
    {
        $this->publications?->detach($publication);
    }

    /**
     * Returns the researches.
     *
     * @return ObjectStorage<Research>
     */
    public function getResearches(): ObjectStorage
    {
        return $this->researches ?? new ObjectStorage();
    }

    /**
     * Sets the researches.
     *
     * @param ObjectStorage<Research> $researches
     */
    public function setResearches(ObjectStorage $researches): void
    {
        $this->researches = $researches;
    }

    /**
     * Adds a research.
     */
    public function addResearch(Research $research): void
    {
        $this->researches?->attach($research);
    }

    /**
     * Removes a research.
     */
    public function removeResearch(Research $research): void
    {
        $this->researches?->detach($research);
    }

    /**
     * Returns the teachings.
     *
     * @return ObjectStorage<Teaching>
     */
    public function getTeachings(): ObjectStorage
    {
        return $this->teachings ?? new ObjectStorage();
    }

    /**
     * Sets the teachings.
     *
     * @param ObjectStorage<Teaching> $teachings
     */
    public function setTeachings(ObjectStorage $teachings): void
    {
        $this->teachings = $teachings;
    }

    /**
     * Adds a teaching.
     */
    public function addTeaching(Teaching $teaching): void
    {
        $this->teachings?->attach($teaching);
    }

    /**
     * Removes a teaching.
     */
    public function removeTeaching(Teaching $teaching): void
    {
        $this->teachings?->detach($teaching);
    }

    /**
     * Returns the person links.
     *
     * @return ObjectStorage<Link>
     */
    public function getPersonLinks(): ObjectStorage
    {
        return $this->personLinks ?? new ObjectStorage();
    }

    /**
     * Sets the person links.
     *
     * @param ObjectStorage<Link> $personLinks
     */
    public function setPersonLinks(ObjectStorage $personLinks): void
    {
        $this->personLinks = $personLinks;
    }

    /**
     * Adds a person link.
     */
    public function addPersonLink(Link $personLink): void
    {
        $this->personLinks?->attach($personLink);
    }

    /**
     * Removes a person link.
     */
    public function removePersonLink(Link $personLink): void
    {
        $this->personLinks?->detach($personLink);
    }
}
