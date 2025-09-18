<?php

namespace Enlace2\LaravelUrlShortener\Models;

class Channel
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $description = null;
    public ?string $color = null;
    public ?string $date = null;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public static function fromArray(array $data): self
    {
        return new static($data);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}