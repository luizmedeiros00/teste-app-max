<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Repository\Product\ProductRepositoryInterface;

class ProductController extends Controller
{

    private $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $products = $this->repository->all();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        $product = new Product();

        return view('product.create', compact('product'));
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $this->repository->create($request->all());

            return back()->with('success', 'Produto cadastrado com sucesso');;
        } catch (\Exception  $e) {
            return back()->withInput()->with('error', 'Erro ao cadastrar o produto');;
        }
    }

    public function show($id)
    {
        $product = $this->repository->find($id);

        return view('product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->repository->find($id);

        return view('product.create', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $this->repository->update($id, $request->all());

            return back()->withInput()->with('success', 'Produto atualizado com sucesso');;
        } catch (\Exception  $e) {
            return back()->withInput()->with('error', 'Erro ao atualizar o produto');;
        }
    }

    public function destroy($id)
    {
        $product = $this->repository->find($id);

        $product->delete();
    }

}
