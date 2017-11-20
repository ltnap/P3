<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 04/11/2017
 * Time: 13:33
 */

namespace Forms\Validators;


class NotNullValidator extends Validator
{
    public function isValid($value)
    {
        return $value != '';
    }
}