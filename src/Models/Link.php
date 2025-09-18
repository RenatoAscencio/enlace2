<?php

namespace Enlace2\LaravelUrlShortener\Models;

class Link
{
    public ?int $id = null;
    public ?string $url = null;
    public ?string $short = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?int $clicks = null;
    public ?int $uniqueclicks = null;
    public ?string $date = null;
    public ?string $status = null;
    public ?string $domain = null;

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