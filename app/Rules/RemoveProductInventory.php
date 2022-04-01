<?php

namespace App\Rules;

use App\Models\Inventory;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class RemoveProductInventory implements Rule, DataAwareRule
{
    protected $data = [];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $inventory = Inventory::where('product_id', $this->data['product_id'])->first();

        return $inventory->current_amount >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A quantidade do produto em estoque é insuficiente';
    }

    public function setData($data)
    {
        $this->data = $data;
 
        return $this;
    }
}
