#Apextech

## Basic configuration
```
composer install
copy .env.example .env
php artisan key:generate
```

Run docker
```
./vendor/bin/sail up
./vendor/bin/sail artisan migrate
```

Test a checkout
Run docker
```
./vendor/bin/sail artisan test --filter=CheckoutTest
```

## Main classes

- Services/Checkout.php - checkout class
- Services/PricingRules/*
  - PricingRule.php - interface for pricing rules
  - PricingRules.php - list of pricing rules
  - PricingRuleBuyOneGetOneFree.php - buy-one-get-one-free offers
  - PricingRuleBulkPurchases.php - bulk purchases offers
  - PricingRuleByOneTargetPercentDiscount.php - additional example of how to implement a rule for a target product


### Example of usage
```php
$productOne = Product::findOne();
$productsTwo = Product::findOne();

// Prepare pricing rules
$this->pricingRules = new PricingRules();
$this->pricingRules->add(new PricingRuleBuyOneGetOneFree($productOne));
$this->pricingRules->add(new PricingRuleBuyOneGetOneFree($productsTwo));

// Process the cart
$co = new Checkout($this->pricingRules);

// scanning products
$co->scan($productOne);
$co->scan($productOne);
$co->scan($productTwo);
$co->scan($productOne);

$price = $co->getTotal();
```

### How to add new rules
- create a new rule class in `namespace App\Services\PricingRules`;
- class should implement PricingRule interface
- class should implement `PricintRule` interface
- work on your custom rule in `applyDiscount` method
```php
namespace App\Services\PricingRules

class PricingRuleNewYearDiscount implements PricingRule
{
    /**
     * @param Product[] $items
     *
     * @return float
     */
    public function applyDiscount(array $items): float
    {
        // implement your custom rule here
        // you can use $items, list of Product objects in basket
        
        // should return the discount amount
        return 0.00;
    }
}
```
