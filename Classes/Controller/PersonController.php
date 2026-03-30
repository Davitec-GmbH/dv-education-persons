<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Controller;

use Davitec\DvEducationPersons\Domain\Model\Person;
use Davitec\DvEducationPersons\Domain\Repository\PersonRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for listing and displaying person records.
 */
class PersonController extends ActionController
{
    /**
     * @param PersonRepository $personRepository Repository for person records
     */
    public function __construct(
        protected readonly PersonRepository $personRepository,
    ) {}

    /**
     * List persons with optional filtering by search term, department, or first letter.
     *
     * Filter parameters are read from the current request. The list can be narrowed
     * down via FlexForm setting `settings.departments` (comma-separated whitelist).
     *
     * @return ResponseInterface The rendered list view
     */
    public function listAction(): ResponseInterface
    {
        $searchTerm = trim((string)($this->request->getParsedBody()['tx_dveducationpersons_personlist']['searchTerm']
            ?? $this->request->getQueryParams()['tx_dveducationpersons_personlist']['searchTerm']
            ?? ''));
        $department = trim((string)($this->request->getParsedBody()['tx_dveducationpersons_personlist']['department']
            ?? $this->request->getQueryParams()['tx_dveducationpersons_personlist']['department']
            ?? ''));
        $letter = trim((string)($this->request->getParsedBody()['tx_dveducationpersons_personlist']['letter']
            ?? $this->request->getQueryParams()['tx_dveducationpersons_personlist']['letter']
            ?? ''));

        if ($searchTerm !== '') {
            $persons = $this->personRepository->findBySearchTerm($searchTerm);
        } elseif ($department !== '') {
            $persons = $this->personRepository->findByDepartment($department);
        } elseif ($letter !== '') {
            $persons = $this->personRepository->findByFirstLetter($letter);
        } else {
            $persons = $this->personRepository->findAll();
        }

        $departmentFilter = trim((string)($this->settings['departments'] ?? ''));
        if ($departmentFilter !== '') {
            $allowedDepartments = array_map('trim', explode(',', $departmentFilter));
            $filteredPersons = [];
            foreach ($persons as $person) {
                if (in_array($person->getDepartment(), $allowedDepartments, true)) {
                    $filteredPersons[] = $person;
                }
            }
            $this->view->assign('persons', $filteredPersons);
        } else {
            $this->view->assign('persons', $persons);
        }

        $this->view->assignMultiple([
            'searchTerm' => $searchTerm,
            'department' => $department,
            'letter' => $letter,
            'departments' => array_combine(
                $this->personRepository->findDistinctDepartments(),
                $this->personRepository->findDistinctDepartments()
            ),
            'itemsPerPage' => (int)($this->settings['itemsPerPage'] ?? 20),
            'detailPid' => (int)($this->settings['detailPid'] ?? 0),
            'listPid' => (int)($this->settings['listPid'] ?? 0),
        ]);

        return $this->htmlResponse();
    }

    /**
     * Show a single person with all related sub-entities.
     *
     * @param Person $person The person to display
     * @return ResponseInterface The rendered detail view
     */
    public function showAction(Person $person): ResponseInterface
    {
        $this->view->assignMultiple([
            'person' => $person,
            'listPid' => (int)($this->settings['listPid'] ?? 0),
        ]);

        return $this->htmlResponse();
    }
}
