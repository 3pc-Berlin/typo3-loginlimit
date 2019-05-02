<?php

namespace WebentwicklerAt\Loginlimit\Domain\Model;

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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Abstract model
 *
 * @author Gernot Leitgab <typo3@webentwickler.at>
 */
abstract class AbstractModel extends AbstractEntity
{
    /**
     * Timestamp
     *
     * @var \DateTime
     */
    protected $tstamp;

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var string
     */
    protected $username;

    public function __construct()
    {
        $this->pid = 0;
    }


    /**
     * @return \DateTime
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }


    /**
     * @param \DateTime $tstamp
     * @return void
     */
    public function setTstamp($tstamp)
    {
        $this->tstamp = $tstamp;
    }


    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }


    /**
     * @param string $ip
     * @return void
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }


    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
}
