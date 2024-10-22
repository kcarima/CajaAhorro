<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait DataCedula
{
    protected function nacionalidad(): Attribute
    {
        return Attribute::make(get: fn ($value, $attributes) => $attributes['cedula'][0]);
    }

    protected function numeroCedula(): Attribute
    {
        return Attribute::make(get: fn ($value, $attributes) => ltrim(substr(string: $attributes['cedula'], offset: 1), '0'));
    }
}
