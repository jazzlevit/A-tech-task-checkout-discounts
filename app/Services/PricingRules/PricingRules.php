<?php

namespace App\Services\PricingRules;

use App\Models\Interfaces\PriceRule;

class PricingRules
{
    /**
     * @var array PriceRule[]
     */
    protected array $rules = [];

    /**
     * @param PriceRule $priceRule
     * @return $this
     */
    public function add(PriceRule $priceRule): self
    {
        $this->rules[] = $priceRule;

        return $this;
    }

    /**
     * @return array PriceRule[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}
