<?php

namespace App\Services;

use App\Models\Offer;

class BaseService
{

    public function checkOffer($serviceType, Offer $offer)
    {
        $classFuncs = get_class_methods($this);
        if (!in_array($serviceType, $classFuncs)) {
            return false;
        }
        return $this->{$serviceType}($offer);
    }
}
