#Apextech

Run a project
```
composer install
copy .env.example .env
php artisan key:generate
./vendor/bin/sail up
./vendor/bin/sail artisan migrate:fresh --seed
```

```
// Run seeders
$products = ProductSeeder::runProductSeeder();

// Prepare pricing rules
$this->pricingRules = new PricingRules();
$this->pricingRules->add(new PricingRuleBuyOneGetOneFree($products['FR1']));
$this->pricingRules->add(new PricingRuleBulkPurchases($products['SR1'], 3, 0.50));

// Process the cart
$co = new Checkout($this->pricingRules);

$co->scan($products['FR1']);
$co->scan($products['FR1']);
//$co->scan(...);
//$co->scan(...);

$price = $co->getTotal();
```
