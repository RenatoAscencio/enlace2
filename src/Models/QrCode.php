<?php

namespace Enlace2\LaravelUrlShortener\Models;

class QrCode
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $data = null;
    public ?string $qr = null;
    public ?string $link = null;
    public ?int $scans = null;
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