<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'amount', 'type_movement_id', 'origin_movement_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function typeMovement()
    {
        return $this->belongsTo(TypeMovement::class);
    }

    public function originMovement()
    {
        return $this->belongsTo(OriginMovement::class);
    }
}
