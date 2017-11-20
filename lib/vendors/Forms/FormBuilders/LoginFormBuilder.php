<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 06/11/2017
 * Time: 15:51
 */

namespace Forms\FormBuilders;

use \Forms\Fields\StringField;
use \Forms\Fields\PassWordField;
use \Forms\Validators\MaxLengthValidator;
use \Forms\Validators\NotNullValidator;

class LoginFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Pseudo',
            'name' => 'username',
            'maxLength' => 50,
            'validators' => [
                new MaxLengthValidator('Le pseudo spécifié est trop long (20 caractères maximum)', 50),
                new NotNullValidator('Merci de spécifier votre pseudo'),
            ],
        ]))
            ->add(new PassWordField([
                'label' => 'Mot de passe',
                'name' => 'password',
                'validators' => [
                    new NotNullValidator('Merci de spécifier votre mot de passe'),
                ],
            ]));
    }
}