<?php

$EM_CONF['jh_captcha'] = [
    'title' => 'Google reCAPTCHA (v2/v3)',
    'description' => 'Use Google reCAPTCHA (v2/v3) in your own TYPO3 extensions, EXT:form, EXT:powermail and EXT:formhandler as spam protection.',
    'category' => 'fe',
    'author' => 'Jan Haffner',
    'author_email' => 'info@jan-haffner.de',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '4.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-10.4.99',
            'php' => '7.1.0-7.4.99',
        ],
    ],
];
