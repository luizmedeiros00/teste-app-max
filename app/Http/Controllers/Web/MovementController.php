<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductInventoryRequest;
use App\Http\Requests\RemoveProductInventoryRequest;
use App\Models\Movement;
use App\Repository\Movement\MovementRepositoryInterface;

class MovementController extends Controller
{

    const ORIGIN_WEB = 1;

    private $repository;

    public function __construct(MovementRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function remove(RemoveProductInventoryRequest $request)
    {
        try {
            $record = $request->all();

            $record['origin_movement_id'] = self::ORIGIN_WEB;

            $this->repository->remove($record);

            return back()->withInput()->with('success', 'Produto baixado com sucesso');;
        } catch (\Exception  $e) {
            dd($e->getMessage());
            return back()->withInput()->with('error', 'Erro ao baixar o produto');;
        }
    }

    public function add(AddProductInventoryRequest $request)
    {
        try {
            $record = $request->all();

            $record['origin_movement_id'] = self::ORIGIN_WEB;
            
            $this->repository->add($record);

            return back()->withInput()->with('success', 'Produto adicionado com sucesso');
        } catch (\Exception  $e) {
            dd($e->getMessage(), $e->getLine());
            return back()->withInput()->with('error', 'Erro ao baixar o produto');;
        }
    }
}
