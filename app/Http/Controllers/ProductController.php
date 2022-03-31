<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $products = $this->model->get();

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
            $this->model->create($request->all());

            return back()->with('success', 'Produto cadastrado com sucesso');;
        } catch (\Exception  $e) {
            return back()->withInput()->with('error', 'Erro ao cadastrar o produto');;
        }
    }

    public function show($id)
    {
        $product = $this->model->findOrFail($id);

        return view('product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->model->findOrFail($id);

        return view('product.create', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = $this->model->find($id);
            $product->update($request->all());

            return back()->withInput()->with('success', 'Produto atualizado com sucesso');;
        } catch (\Exception  $e) {
            return back()->withInput()->with('error', 'Erro ao atualizar o produto');;
        }
    }

    public function destroy($id)
    {
        $product = $this->model->findOrFail($id);

        $product->delete();
    }
}
