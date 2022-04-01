<?php

namespace App\Repository\Movement;

interface MovementRepositoryInterface
{
    public function remove(array $data);

    public function add(array $data);
}