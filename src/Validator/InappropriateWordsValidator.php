<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class InappropriateWordsValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        $value = strtolower($value);
        foreach ($constraint->listWords as $inappropriateWord) {
            if (str_contains($value, $inappropriateWord)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ inappropriateWord }}', $inappropriateWord)
                    ->addViolation();
            }
        }
    }
}