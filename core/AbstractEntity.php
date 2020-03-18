<?php
class AbstractEntity
{
    public function hydrate($data){
        foreach ($data as $property => $value) {
            if(array_key_exists($property, $this->convertToArray())) {
                $this->$property = $value;
            }
        }
    }

    public function convertToArray()
    {
        return get_object_vars($this);
    }
}
