<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 04/11/2017
 * Time: 16:18
 */

namespace Forms\FormBuilders;

use \framework\Entity;
use \Forms\Form;


abstract class FormBuilder
{
    protected $form;

    public function __construct(Entity $entity)
    {
        $this->setForm(new Form($entity));
    }

    abstract public function build();

    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    public function form()
    {
        return $this->form;
    }

}