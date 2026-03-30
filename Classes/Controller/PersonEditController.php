<?php

declare(strict_types=1);

namespace Davitec\DvEducationPersons\Controller;

use Davitec\DvEducationPersons\Domain\Model\Person;
use Davitec\DvEducationPersons\Domain\Repository\PersonRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Controller for frontend editing of the logged-in person's own profile.
 */
class PersonEditController extends ActionController
{
    /**
     * @param PersonRepository $personRepository Repository for person records
     * @param Context $context TYPO3 context API for accessing the current frontend user
     * @param PersistenceManager $persistenceManager Extbase persistence manager
     */
    public function __construct(
        protected readonly PersonRepository $personRepository,
        protected readonly Context $context,
        protected readonly PersistenceManager $persistenceManager,
    ) {}

    /**
     * Show the edit form for the currently logged-in frontend user's person record.
     *
     * If no user is logged in, a flash message is added and an empty view is returned.
     *
     * @return ResponseInterface The rendered edit form or an error view
     */
    public function editAction(): ResponseInterface
    {
        $feUserId = $this->getLoggedInFeUserId();

        if ($feUserId === 0) {
            $this->addFlashMessage(
                LocalizationUtility::translate('edit.notLoggedIn', 'DvEducationPersons') ?? '',
                LocalizationUtility::translate('edit.notLoggedIn.title', 'DvEducationPersons') ?? '',
                ContextualFeedbackSeverity::ERROR
            );

            return $this->htmlResponse();
        }

        $person = $this->personRepository->findByUid($feUserId);

        if ($person === null) {
            $this->addFlashMessage(
                LocalizationUtility::translate('edit.profileNotFound', 'DvEducationPersons') ?? '',
                LocalizationUtility::translate('edit.profileNotFound.title', 'DvEducationPersons') ?? '',
                ContextualFeedbackSeverity::WARNING
            );

            return $this->htmlResponse();
        }

        $this->view->assign('person', $person);

        return $this->htmlResponse();
    }

    /**
     * Allow property mapping for the person argument in updateAction.
     */
    public function initializeUpdateAction(): void
    {
        $propertyMappingConfiguration = $this->arguments->getArgument('person')->getPropertyMappingConfiguration();
        $propertyMappingConfiguration->allowProperties(
            'department',
            'position',
            'room',
            'telephone',
            'mobile',
            'fax',
            'www',
            'teachingArea',
            'consultationHours',
        );
        $propertyMappingConfiguration->setTypeConverterOption(
            PersistentObjectConverter::class,
            PersistentObjectConverter::CONFIGURATION_MODIFICATION_ALLOWED,
            true
        );
    }

    /**
     * Persist updates to the person record after validating ownership.
     *
     * Ensures the person being edited belongs to the currently logged-in frontend
     * user to prevent unauthorized modifications. On success, redirects back to the
     * edit form with a confirmation flash message.
     *
     * @param Person $person The person model with updated data from the form
     * @return ResponseInterface A redirect response back to the edit action
     */
    public function updateAction(Person $person): ResponseInterface
    {
        $feUserId = $this->getLoggedInFeUserId();

        if ($feUserId === 0 || $person->getUid() !== $feUserId) {
            $this->addFlashMessage(
                LocalizationUtility::translate('edit.accessDenied', 'DvEducationPersons') ?? '',
                LocalizationUtility::translate('edit.accessDenied.title', 'DvEducationPersons') ?? '',
                ContextualFeedbackSeverity::ERROR
            );

            return $this->redirect('edit');
        }

        $this->personRepository->update($person);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            LocalizationUtility::translate('edit.success', 'DvEducationPersons') ?? '',
            LocalizationUtility::translate('edit.success.title', 'DvEducationPersons') ?? '',
            ContextualFeedbackSeverity::OK
        );

        return $this->redirect('edit');
    }

    /**
     * Get the UID of the currently logged-in frontend user.
     *
     * @return int The fe_user UID or 0 if no user is logged in
     */
    protected function getLoggedInFeUserId(): int
    {
        return (int)$this->context->getPropertyFromAspect('frontend.user', 'id');
    }
}
