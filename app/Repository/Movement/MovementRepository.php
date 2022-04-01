<?php

namespace App\Repository\Movement;

use App\Models\Movement;
use App\Repository\BaseRepository;

class MovementRepository extends BaseRepository implements MovementRepositoryInterface
{
    const REMOVE_TYPE = 2;
    const ADD_TYPE = 1;
    
    public function __construct()
    {
        parent::__construct(new Movement());
    }

    public function remove(array $data)
    {
        return $this->model->create([
            'product_id'            => $data['product_id'],
            'amount'                => $data['amount'],
            'type_movement_id'      => self::REMOVE_TYPE,
            'origin_movement_id'    => $data['origin_movement_id'],
            'user_id'               => $data['user_id']
        ]);
    }

    public function add(array $data)
    {
        return $this->model->create([
            'product_id'            => $data['product_id'],
            'amount'                => $data['amount'],
            'type_movement_id'      => self::ADD_TYPE,
            'origin_movement_id'    => $data['origin_movement_id'],
            'user_id'               => $data['user_id']
        ]);
    }
}