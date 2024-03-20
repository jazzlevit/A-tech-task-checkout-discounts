<?php

namespace App\Services\PricingRules;

class PricingRules
{
    /**
     * @var array PriceRule[]
     */
    protected array $rules = [];

    /**
     * @param PricingRule $priceRule
     * @return $this
     */
    public function add(PricingRule $priceRule): self
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
