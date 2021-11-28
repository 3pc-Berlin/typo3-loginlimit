<?php
namespace WebentwicklerAt\Loginlimit\Command;

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

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use WebentwicklerAt\Loginlimit\Service\CleanUpService;

/**
 * Symfony command to cleanup expired login attempts and bans
 *
 * @author Gernot Leitgab <typo3@webentwickler.at>
 */
class CleanupCommand extends Command
{

    protected function configure(): void
    {
        $this->setDescription('Cleanup expired login attempts and bans');
    }

    /**
     * Deletes expired login attempts and bans
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var CleanUpService $service */
        $service = GeneralUtility::makeInstance(CleanUpService::class);
        $service->deleteExpiredEntries();
        $output->writeln('Expired login attempts and bans deleted.');
        return 0;
    }
}
