<?php

namespace App\Services\PricingRules;

use App\Models\Product;

/**
 * Interface PricingRule
 */
interface PricingRule
{
    /**
     * @param Product[] $items
     *
     * @return float
     */
    public function applyDiscount(array $items): float;
}
