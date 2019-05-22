<?php

namespace WebentwicklerAt\Loginlimit\Service;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;
use WebentwicklerAt\Loginlimit\Domain\Repository\BanRepository;
use WebentwicklerAt\Loginlimit\Domain\Repository\LoginAttemptRepository;

/**
 * Service cleans up expired entries
 *
 * @author Gernot Leitgab <typo3@webentwickler.at>
 */
class CleanUpService implements SingletonInterface
{
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var PersistenceManagerInterface
     */
    protected $persistenceManager;

    /**
     * Repository for login attempt
     *
     * @var LoginAttemptRepository
     */
    protected $loginAttemptRepository;

    /**
     * Repository for ban
     *
     * @var BanRepository
     */
    protected $banRepository;

    /**
     * Extension manager settings
     *
     * @var array
     */
    protected $settings;


    /**
     * Injects object manager
     *
     * @param ObjectManagerInterface $objectManager
     * @return void
     */
    public function injectObjectManager(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }


    /**
     * Injects persistence manager
     *
     * @param PersistenceManagerInterface $persistenceManager
     * @return void
     */
    public function injectPersistenceManager(PersistenceManagerInterface $persistenceManager)
    {
        $this->persistenceManager = $persistenceManager;
    }


    /**
     * Injects repository for login attempt
     *
     * @param LoginAttemptRepository $loginAttemptRepository
     * @return void
     */
    public function injectLoginAttemptRepository(LoginAttemptRepository $loginAttemptRepository)
    {
        $this->loginAttemptRepository = $loginAttemptRepository;
    }


    /**
     * Injects repository for ban
     *
     * @param BanRepository $banRepository
     * @return void
     */
    public function injectBanRepository(BanRepository $banRepository)
    {
        $this->banRepository = $banRepository;
    }


    /**
     * Initializes object
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->settings = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('loginlimit');
    }


    /**
     * Deletes all expired entries
     *
     * @return void
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function deleteExpiredEntries()
    {
        $this->deleteExpiredLoginAttempts();
        $this->deleteExpiredBans();
        $this->persistenceManager->persistAll();
    }


    /**
     * Deletes expired login attempts
     *
     * @return void
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    protected function deleteExpiredLoginAttempts()
    {
        $findtime = $this->settings['findtime'];
        $expiredEntries = $this->loginAttemptRepository->findExpired($findtime);
        foreach ($expiredEntries as $expiredEntry) {
            $this->loginAttemptRepository->remove($expiredEntry);
        }
    }


    /**
     * Deletes expired bans
     *
     * @return void
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    protected function deleteExpiredBans()
    {
        $bantime = $this->settings['bantime'];
        if ($bantime >= 0) {
            $expiredEntries = $this->banRepository->findExpired($bantime);
            foreach ($expiredEntries as $expiredEntry) {
                $this->banRepository->remove($expiredEntry);
            }
        }
    }
}
