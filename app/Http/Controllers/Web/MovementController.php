<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductInventoryRequest;
use App\Http\Requests\RemoveProductInventoryRequest;
use App\Repository\Movement\MovementRepositoryInterface;
use App\Repository\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class MovementController extends Controller
{

    const ORIGIN_WEB = 1;

    private $repository, $productRepository;

    public function __construct(
        MovementRepositoryInterface $repository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->repository = $repository;
        $this->productRepository = $productRepository;
    }

    public function report(Request $request)
    {   
        $productsAlert = $this->productRepository->withLowInventory();

        $products = $this->productRepository->all();
        $movements = $this->repository->report($request->all());
        return view('reports.index', compact('movements', 'products', 'productsAlert'));
    }

    public function remove(RemoveProductInventoryRequest $request)
    {
        try {
            $record = $request->all();

            $record['origin_movement_id'] = self::ORIGIN_WEB;
            $record['user_id'] = auth()->user()->id;

            $this->repository->remove($record);

            return back()->withInput()->with('success', 'Produto baixado com sucesso');;
        } catch (\Exception  $e) {
            return back()->withInput()->with('error', 'Erro ao baixar o produto');;
        }
    }

    public function add(AddProductInventoryRequest $request)
    {
        try {
            $record = $request->all();

            $record['origin_movement_id'] = self::ORIGIN_WEB;
            $record['user_id'] = auth()->user()->id;

            $this->repository->add($record);

            return back()->withInput()->with('success', 'Produto adicionado com sucesso');
        } catch (\Exception  $e) {
            return back()->withInput()->with('error', 'Erro ao baixar o produto');;
        }
    }
}
