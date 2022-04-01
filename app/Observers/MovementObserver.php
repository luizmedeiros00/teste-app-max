<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\Movement;

class MovementObserver
{
    /**
     * Handle the Movement "created" event.
     *
     * @param  \App\Models\Movement  $movement
     * @return void
     */
    public function created(Movement $movement)
    {
        $inventory = $movement->product->inventory;
        
        if ($movement->type_movement_id == 1) {
            $inventory->current_amount = $inventory->current_amount + $movement->amount;
        } else {
            $inventory->current_amount = $inventory->current_amount - $movement->amount;
        }

        $inventory->save();
    }

    /**
     * Handle the Movement "updated" event.
     *
     * @param  \App\Models\Movement  $movement
     * @return void
     */
    public function updated(Movement $movement)
    {
        //
    }

    /**
     * Handle the Movement "deleted" event.
     *
     * @param  \App\Models\Movement  $movement
     * @return void
     */
    public function deleted(Movement $movement)
    {
        //
    }

    /**
     * Handle the Movement "restored" event.
     *
     * @param  \App\Models\Movement  $movement
     * @return void
     */
    public function restored(Movement $movement)
    {
        //
    }

    /**
     * Handle the Movement "force deleted" event.
     *
     * @param  \App\Models\Movement  $movement
     * @return void
     */
    public function forceDeleted(Movement $movement)
    {
        //
    }
}
