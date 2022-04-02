@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Produto</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" disabled value="{{ $product->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sku">SKU</label>
                                    <input type="text" disabled value="{{ $product->sku }}" class="form-control" </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sku">Quantidade em Estoque</label>
                                    <input type="text" disabled value="{{ $product->inventory->current_amount }}"
                                        class="form-control" </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sku">Data do cadastro</label>
                                    <input type="text" disabled value="{{ $product->created_at->format('d/m/Y') }}"
                                        class="form-control" </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Movimentações</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Quantidade Movimentada</th>
                                <th>Tipo de Movimentação</th>
                                <th>Via</th>
                                <th>Data da movimentação</th>
                            </thead>
                            <tbody>
                                @foreach ($product->movements as $movement)
                                    <tr>
                                        <td
                                            style="color: {{ $movement->typeMovement->name == 'Saída' ? 'red' : 'green' }};">
                                            {{ $movement->amount }}</td>
                                        <td>{{ $movement->typeMovement->name }}</td>
                                        <td>{{ $movement->originMovement->name }}</td>
                                        <td>{{ $movement->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
