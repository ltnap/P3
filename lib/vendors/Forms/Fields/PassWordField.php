<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 06/11/2017
 * Time: 15:44
 */

namespace Forms\Fields;

class PassWordField extends Field
{
    protected $maxLength;

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->errorMessage))
        {
            $widget .= $this->errorMessage.'<br />';
        }

        $widget .= '<label>'.$this->label.'</label>';

        $widget .= ' <input type="password" name="'.$this->name.'" class="form-control" placeholder="'.$this->name.'" <br /><br /> ';

        if (!empty($this->value))
        {
            $widget .= ' value="'.htmlspecialchars($this->value).'"';
        }

        if (!empty($this->maxLength))
        {
            $widget .= ' maxlength="'.$this->maxLength.'"';
        }

        return $widget;
    }

    public function setMaxLength($maxLength)
    {
        $maxLength = (int)$maxLength;

        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
        }
    }
}