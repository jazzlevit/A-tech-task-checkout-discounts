<?php

namespace App\Services\PricingRules;

use App\Models\Interfaces\PriceRule;
use App\Models\Product;
use LengthException;
use function Psy\debug;

class PricingRuleByOneTargetPercentDiscount implements PriceRule
{
    /**
     * Price rule requires to specify the product
     *
     * @param Product $product
     */
    public function __construct(
        readonly Product $product,
        readonly Product $targetProduct,
        readonly int $discountPercent
    ) {
        if ($this->discountPercent <= 0 || $this->discountPercent > 100) {
            throw new LengthException('Discount percent must be between 1 and 100');
        }
    }

    /**
     * @param Product[] $items
     *
     * @return float
     */
    public function applyDiscount(array $items): float
    {
        $discount = 0.00;
        $count = 0;
        $countTarget = 0;

        foreach ($items as $item) {
            if ($item->id === $this->product->id) {
                $count++;
            }
            if ($item->id === $this->targetProduct->id) {
                $countTarget++;
            }
        }

        if ($count > 0 && $countTarget > 0) {
            $min = min($count, $countTarget);

            $discount = ($this->targetProduct->price / 100 * $this->discountPercent) * $min;
        }

        return (float)round($discount, 2);
    }
}
