<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude([
        'vendor',
        'storage',
        'tests/_data'
    ])
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR12' => true,
	'concat_space' => ['spacing' => 'one'],
	'single_quote' => true,
	'array_syntax' => ['syntax' => 'short'],
])->setFinder($finder);
