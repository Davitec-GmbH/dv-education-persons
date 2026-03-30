<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Domain model for a link.
 */
class Link extends AbstractEntity
{
    protected string $title = '';

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
