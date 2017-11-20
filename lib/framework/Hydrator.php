<?php
/**
 * Created by PhpStorm.
 * User: Ltnap
 * Date: 04/11/2017
 * Time: 12:22
 */

namespace framework;


trait Hydrator
{
    public function hydrate($data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (is_callable([$this, $method]))
            {
                $this->$method($value);
            }
        }
    }
}