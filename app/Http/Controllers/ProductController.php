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
        return view('product.create');
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = $this->model->create($request->all());

            return view('product.show', compact('product'));
        } catch(\Exception  $e){
            // return response([
            //     'message'   => 'Não foi possível cadastrar o produto',
            //     'error'     => $e->getMessage()
            // ], 500);
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

            return view('product.show', compact('product'));
        } catch(\Exception  $e){
            // return response([
            //     'message'   => 'Não foi possível atualizar o produto',
            //     'error'     => $e->getMessage()
            // ], 500);
        }
    }

    public function destroy($id)
    {
        $product = $this->model->findOrFail($id);

        $product->delete();
    }
}
