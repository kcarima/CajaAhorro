<?php

namespace App\Traits;

trait RouteUuid
{
    protected $routeKeyName = 'uuid';

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('uuid', $value)->firstOrFail();
    }
}
