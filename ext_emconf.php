<?php
$EM_CONF[$_EXTKEY] = [
	'title' => 'Login limit',
	'description' => 'Protect backend and/or frontend login from brute-force attacks.',
	'category' => 'misc',
	'version' => '8.0.0',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 1,
	'author' => 'Gernot Leitgab',
	'author_email' => 'typo3@webentwickler.at',
	'author_company' => 'Webentwickler.at',
	'constraints' => [
		'depends' => [
			'typo3' => '6.2.0-8.7.99',
			'scheduler' => '6.2.0-8.7.99',
        ],
		'conflicts' => [],
		'suggests' => [],
    ],
];
