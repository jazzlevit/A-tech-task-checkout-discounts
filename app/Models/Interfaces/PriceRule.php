<?php

namespace App\Models\Interfaces;

interface PriceRule
{
    public function applyDiscount(array $items): float;
}
