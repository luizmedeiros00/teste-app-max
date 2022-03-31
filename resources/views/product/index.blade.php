@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Produtos</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Nome</th>
                                <th>SKU</th>
                                <th>Ações</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-block">
                                                <a href="{{route('products.edit', ['product' => $product->id])}}" class="btn btn-primary btn-sm">editar</a>
                                                   <button class="btn btn-danger btn-sm">deletar</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
