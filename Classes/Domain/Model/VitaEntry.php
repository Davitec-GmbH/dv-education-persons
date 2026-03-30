<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Domain model for a vita entry.
 */
class VitaEntry extends AbstractEntity
{
    protected string $title = '';

    protected string $description = '';

    protected ?\DateTime $dateStart = null;

    protected ?\DateTime $dateEnd = null;

    protected int $sorting = 0;

    /**
     * Returns the title.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title.
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Returns the description.
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the description.
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Returns the start date.
     */
    public function getDateStart(): ?\DateTime
    {
        return $this->dateStart;
    }

    /**
     * Sets the start date.
     */
    public function setDateStart(?\DateTime $dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    /**
     * Returns the end date.
     */
    public function getDateEnd(): ?\DateTime
    {
        return $this->dateEnd;
    }

    /**
     * Sets the end date.
     */
    public function setDateEnd(?\DateTime $dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * Returns the sorting.
     */
    public function getSorting(): int
    {
        return $this->sorting;
    }

    /**
     * Sets the sorting.
     */
    public function setSorting(int $sorting): void
    {
        $this->sorting = $sorting;
    }
}
