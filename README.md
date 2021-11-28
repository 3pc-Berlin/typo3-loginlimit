# TYPO3 Extension `loginlimit`

_Protect backend and/or frontend login from brute-force attacks_

Copyright: 2015-2017 \
Author: Gernot Leitgab <typo3@webentwickler.at> http://webentwickler.at \
License: GNU GENERAL PUBLIC LICENSE

## Introduction

### What does it do?

This extension allows to protect backend and/or frontend login against brute-force attacks.

If a configured number of failed login attempts with one and the same IP and/or username is reached, further logins are prohibited for this IP and/or username.

### Links

Git-Repository: https://github.com/WebentwicklerAt/typo3-loginlimit

Issues: https://github.com/WebentwicklerAt/typo3-loginlimit/issues

## Users Manual

Import and install the newest version of this extension from TYPO3 Extension Repository (TER).

### Configuration

The configuration is done in the extension configuration (Admin Tools > Settings).

* **enableBackend**: Enable login limit for Backend.
* **enableFrontend**: Enable login limit for Frontend.
* **enableCleanUpAtLogin**: Enable clean up expired entries at login, alternatively a scheduler task can be set-up.
* **delayLogin**: Every failed login attempt delays login for 1 second. Max. 10 seconds.
* **findtime**: Time frame (in seconds) to look for failed login attempts.
* **maxretry**: Number of failed login attempts within findtime causing a ban for bantime.
* **bantime**: Duration (in seconds) to be banned for. Negative number for "permanent" ban.

### Add scheduler task

First of all please make sure that you have installed and set-up the extension "scheduler" properly. Therefore the "Setup check" is provided in the module "Scheduler".

In module "Scheduler" add a new task, select "Extbase CommandController Task" as "Class", set desired "Frequency" and select "Loginlimit Task: cleanUp" as "CommandController Command".

If clean-up is done through scheduler task, the option "enableCleanUpAtLogin" in extension configuration should be disabled.

You can also run cleanup via CLI

    vendor/bin/typo3 loginlimit:cleanup
