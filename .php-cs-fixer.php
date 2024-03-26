<?php

declare(strict_types=1);

use PhpCsFixer\RuleSet\RuleSet;
use PhpCsFixer\RuleSet\RuleSets;

$finder = PhpCsFixer\Finder::create()
    ->in('./config/')
    ->in('./migrations/')
    ->in('./src/')
    ->in('./tests/')
    ->append(['.php-cs-fixer.php'])
;

$ruleSet = new RuleSet();

$rules = array_reduce(
    RuleSets::getSetDefinitionNames(),
    static function (array $carry, string $ruleSetName): array {
        $carry[$ruleSetName] = true;

        return $carry;
    },
    [],
);

$rules['blank_line_before_statement'] = [
    'statements' => [
        'break',
        'case',
        'continue',
        'default',
        'exit',
        'for',
        'foreach',
        'if',
        'return',
        'switch',
        'throw',
        'try',
        'while',
        'yield',
    ],
];

$rules['class_attributes_separation'] = [
    'elements' => [
        'method' => 'one',
        'property' => 'one',
    ],
];

$rules['global_namespace_import'] = true;
$rules['linebreak_after_opening_tag'] = true;

$rules['ordered_class_elements'] = [
    'sort_algorithm' => 'alpha',
    'order' => [
        'use_trait',

        'constant',
        'constant_public',
        'constant_protected',
        'constant_private',

        'property_static',
        'property_public_static',
        'property',
        'property_public',
        'property_protected_static',
        'property_protected',
        'property_private_static',
        'property_private',

        'construct',

        'method_public_static',
        'method',
        'method_public',
        'method_protected_static',
        'method_protected',
        'method_private_static',
        'method_private',

        'magic',
        'destruct',
        'phpunit',
    ],
];

$rules['phpdoc_line_span'] = [
    'property' => 'single',
];

$rules['single_line_throw'] = false;
$rules['static_lambda'] = true;
$rules['use_arrow_functions'] = true;

$rules['ordered_imports'] = [
    'imports_order' => ['class', 'function', 'const'],
];

$rules['trailing_comma_in_multiline'] = [
    'elements' => ['arrays', 'arguments', 'parameters'],
];

$rules['return_assignment'] = false;

$rules['single_line_empty_body'] = false;

$rules['phpdoc_align'] = [
    'align' => 'left',
    'tags' => ['method', 'param', 'property', 'return', 'throws', 'type', 'var'],
];

return (new PhpCsFixer\Config())->setRules($rules)->setFinder($finder);
