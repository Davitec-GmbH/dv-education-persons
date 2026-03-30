<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Domain model for a publication.
 */
class Publication extends AbstractEntity
{
    protected string $title = '';

    protected string $description = '';

    protected ?\DateTime $date = null;

    protected string $url = '';

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
     * Returns the date.
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * Sets the date.
     */
    public function setDate(?\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * Returns the URL.
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Sets the URL.
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
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
