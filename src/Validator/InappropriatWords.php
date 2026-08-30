<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class InappropriateWords extends Constraint
{
    public function __construct(
        public array $listWords = [],
        public string $message = 'Ce champ contient un mot non autorisé : "{{ inappropriateWord }}".',
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null
    ) {
        parent::__construct($options, $groups, $payload);
    }
}