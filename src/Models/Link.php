<?php

namespace Enlace2\LaravelUrlShortener\Models;

class Link
{
    public $id;
    public $url;
    public $short;
    public $title;
    public $description;
    public $clicks;
    public $uniqueclicks;
    public $date;
    public $status;
    public $domain;

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