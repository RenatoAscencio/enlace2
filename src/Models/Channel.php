<?php

namespace Enlace2\LaravelUrlShortener\Models;

class Channel
{
    public $id;
    public $name;
    public $description;
    public $color;
    public $date;

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public static function fromArray($data)
    {
        return new static($data);
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}