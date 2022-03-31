<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeMovement extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function movement()
    {
        return $this->hasMany(Movement::class);
    }
}
