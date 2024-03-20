<?php

namespace App\Services\PricingRules;

interface PricingRule
{
    public function applyDiscount(array $items): float;
}
