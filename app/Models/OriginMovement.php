<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OriginMovement extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function movement()
    {
        return $this->hasMany(Movement::class);
    }
}
