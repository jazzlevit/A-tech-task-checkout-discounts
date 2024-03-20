<?php

namespace App\Services\PricingRules;

use App\Models\Interfaces\PriceRule;
use App\Models\Product;

class PricingRuleBuyOneGetOneFree implements PriceRule
{
    /**
     * Price rule requires to specify the product
     *
     * @param Product $product
     */
    public function __construct(readonly Product $product) {}

    /**
     * @param Product[] $items
     *
     * @return float
     */
    public function applyDiscount(array $items): float
    {
        $discount = 0.00;
        $count = 0;

        foreach ($items as $item) {
            if ($item->id === $this->product->id) {
                $count++;
            }
        }

        if ($count >= 2) {
            $discount = floor($count/2) * $this->product->price;
        }

        return (float)$discount;
    }
}
