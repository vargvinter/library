<?php

namespace App\Filters;

use App\Filters\Filters;

trait Filterable
{
    public function scopeFilter($query, Filters $filters)
    {
        return $filters->apply($query);
    }
}
