<?php

namespace Core;

abstract class AbstractEntity
{
    public function hydrate($data){
        foreach ($data as $property => $value) {
            //if(array_key_exists($property, $this->convertToArray())) {
                $method = 'set'.ucfirst($property);
                echo '<br>';
                if(method_exists($this, $method)) {
                    $this->$method($value);
                }
            //}
        }

        return $this; // use to fluent pattern
    }

    public function convertToArray()
    {
        unset($this->id);

        return get_object_vars($this);
    }
}
