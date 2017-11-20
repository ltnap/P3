<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 04/11/2017
 * Time: 16:24
 */

namespace Forms\FormBuilders;


use \Forms\Fields\StringField;
use \Forms\Fields\TextField;
use \Forms\Validators\MaxLengthValidator;
use \Forms\Validators\NotNullValidator;

class CommentFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Pseudo',
            'name' => 'auteur',
            'id' => 'auteur',
            'maxLength' => 50,
            'validators' => [
                new MaxLengthValidator('L\'auteur spécifié est trop long (50 caractères maximum)', 50),
                new NotNullValidator('Merci de spécifier l\'auteur du commentaire'),
            ],
        ]))
            ->add(new TextField([
                'label' => 'Votre commentaire',
                'name' => 'content',
                'id' => "content",
                'class' => 'form-control',
                'rows' => 7,
                'cols' => 50,
                'validators' => [
                    new NotNullValidator('Merci de spécifier votre commentaire'),
                ],
            ]));
    }
}