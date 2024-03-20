<?php

namespace App\Services;

use App\Models\Product;
use App\Services\PricingRules\PricingRules;

class Checkout
{
    /**
     * @var float $total
     */
    private float $total = 0.00;

    /**
     * @var Product[] $items
     */
    private array $items;

    /**
     * @param PricingRules $pricingRules
     */
    public function __construct(private PricingRules $pricingRules){}

    /**
     * @param Product $product
     *
     * @return void
     */
    public function scan(Product $product): void
    {
        $this->items[] = $product;

        $this->calculateTotal();
    }

    /**
     * Calculates total
     *
     * @return void
     */
    private function calculateTotal(): void
    {
        $this->total = 0;
        foreach ($this->items as $item) {
            $this->total += $item->price;
        }

        $this->applyDiscount();

        $this->total = round($this->total, 2);
    }

    /**
     * Applies discount using rules
     *
     * @return void
     */
    private function applyDiscount(): void
    {
        foreach ($this->pricingRules->getRules() as $priceRule) {
            $discount = $priceRule->applyDiscount($this->items);

            if ($discount > 0){
                $this->total -= $discount;
            }
        }
    }

    /**
     * Return total price
     *
     * @return float|int
     */
    public function getTotal(): float|int
    {
        return $this->total;
    }
}
