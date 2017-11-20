<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 04/11/2017
 * Time: 16:28
 */

namespace Forms\FormBuilders;


use \Forms\Fields\StringField;
use \Forms\Fields\TextField;
use \Forms\Validators\MaxLengthValidator;
use \Forms\Validators\NotNullValidator;

class NewsFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Auteur',
            'name' => 'auteur',
            'maxLength' => 20,
            'validators' => [
                new MaxLengthValidator('L\'auteur spécifié est trop long (20 caractères maximum)', 20),
                new NotNullValidator('Merci de spécifier l\'auteur de la news'),
            ],
        ]))
            ->add(new StringField([
                'label' => 'Titre',
                'name' => 'titre',
                'maxLength' => 100,
                'validators' => [
                    new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
                    new NotNullValidator('Merci de spécifier le titre de la news'),
                ],
            ]))
            ->add(new TextField([
                'label' => 'Votre article',
                'name' => 'content',
                'class' => 'form-control newsTextarea',
                'rows' => 8,
                'cols' => 60,
                'validators' => [
                    new NotNullValidator('Merci de spécifier le contenu de la news'),
                ],
            ]));
    }
}