<?php

namespace App\Repository\Product;

use App\Models\Product;
use App\Repository\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Product());
    }

    public function withLowInventory($amount = 100)
    {
        return $this->model->whereHas('inventory', function ($q) use ($amount) {
            return $q->where('current_amount', '<', $amount);
        })->get();
    }
}
