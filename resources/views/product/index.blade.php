@extends('layouts.app')

@section('content')
    <div class="container">
    @include('partials.alerts')
        <div class="row justify-content-center">

            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Produtos
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Nome</th>
                                <th>SKU</th>
                                <th>Quantidade</th>
                                <th>Ações</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->inventory->current_amount }}</td>
                                        <td>
                                            <div >
                                                <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                                    class="btn btn-primary btn-sm">editar</a>
                                                <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                                    method="post">
                                                    <input class="btn btn-danger btn-sm" type="submit" value="deletar" />
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                       
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
