<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'sku'];

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
