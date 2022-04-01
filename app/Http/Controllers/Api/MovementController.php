<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductInventoryRequest;
use App\Http\Requests\RemoveProductInventoryRequest;
use App\Repository\Movement\MovementRepositoryInterface;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    const ORIGIN_API = 2;

    private $repository;

    public function __construct(MovementRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function remove(RemoveProductInventoryRequest $request)
    {
        try {
            $record = $request->all();

            $record['origin_movement_id'] = self::ORIGIN_API;
            $record['user_id'] = auth('api')->user()->id;

            $this->repository->remove($record);

            return response('Produto baixado com sucesso');
        } catch (\Exception  $e) {
            return response('Erro ao baixar o produto', 500);
        }
    }

    public function add(AddProductInventoryRequest $request)
    {
        try {
            $record = $request->all();

            $record['origin_movement_id'] = self::ORIGIN_API;
            $record['user_id'] = auth('api')->user()->id;
           
            $this->repository->add($record);

            return response('Produto adicionado com sucesso');
        } catch (\Exception  $e) {
            return response('Erro ao baixar o produto', 500);
        }
    }
}
