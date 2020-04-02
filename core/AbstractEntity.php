<?php

namespace Core;

abstract class AbstractEntity
{
    public function hydrate(array $data){
        foreach ($data as $property => $value) {
            $method = 'set'.ucfirst($property);
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        return $this; // use to fluent pattern
    }

        /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function convertToArray()
    {
        $data = get_object_vars($this);
        unset($data['id']);

        return $data;
    }
}
