<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 01/11/2017
 * Time: 13:58
 */

namespace framework;


class Config extends ApplicationComponent
{
    protected $vars = [];

    public function get($var)
    {
        if (!$this->vars)
        {
            $xml = new \DOMDocument;
            $xml->load(__DIR__.'/../../App/'.$this->app->name().'/Config/app.xml');

            $elements = $xml->getElementsByTagName('define');

            foreach ($elements as $element)
            {
                $this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
            }
        }

        if (isset($this->vars[$var]))
        {
            return $this->vars[$var];
        }

        return null;
    }
}