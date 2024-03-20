<?php

namespace Tests\Feature;

use App\Services\Checkout;
use App\Services\PricingRules\PricingRuleBulkPurchases;
use App\Services\PricingRules\PricingRuleBuyOneGetOneFree;
use App\Services\PricingRules\PricingRuleByOneTargetPercentDiscount;
use App\Services\PricingRules\PricingRules;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    private array $products;
    private PricingRules $pricingRules;

    public function setUp(): void
    {
        parent::setUp();

        $this->products = ProductSeeder::runProductSeeder();

        $this->pricingRules = new PricingRules();
        $this->pricingRules->add(new PricingRuleBuyOneGetOneFree($this->products['FR1']));
        $this->pricingRules->add(new PricingRuleBulkPurchases($this->products['SR1'], 3, 0.50));
    }

    public function test_basket_case_1(): void
    {
        $co = new Checkout($this->pricingRules);

        $co->scan($this->products['FR1']);
        $co->scan($this->products['SR1']);
        $co->scan($this->products['FR1']);
        $co->scan($this->products['FR1']);
        $co->scan($this->products['CF1']);

        $price = $co->getTotal();

        $this->assertEquals(22.45, $price);
    }

    public function test_basket_case_2(): void
    {
        $co = new Checkout($this->pricingRules);

        $co->scan($this->products['FR1']);
        $co->scan($this->products['FR1']);

        $price = $co->getTotal();

        $this->assertEquals(3.11, $price);
    }

    public function test_basket_case_3(): void
    {
        $co = new Checkout($this->pricingRules);

        $co->scan($this->products['SR1']);
        $co->scan($this->products['SR1']);
        $co->scan($this->products['FR1']);
        $co->scan($this->products['SR1']);

        $price = $co->getTotal();

        $this->assertEquals(16.61, $price);
    }

    public function test_basket_case_4(): void
    {
        // One more test rule for target product having 50% discount
        $this->pricingRules->add(
            new PricingRuleByOneTargetPercentDiscount(
                $this->products['SR1'],
                $this->products['FR1'],
                50
            )
        );

        $co = new Checkout($this->pricingRules);

        $co->scan($this->products['SR1']);
        $co->scan($this->products['FR1']);

        $price = $co->getTotal();

        $this->assertEquals(6.55, $price);
    }
}
