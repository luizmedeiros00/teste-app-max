@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-center">

            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        Movimentações
                    </div>
                    <div class="card-body">

                        <div class="card-title">Filtros</div>
                        <form action="{{ route('reports') }}" method="GET">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="data_inicial">Data Inicial</label>
                                        <input type="date" id="data_inicial" value="{{ request()->get('data_inicial') }}"
                                            class="form-control" name="data_inicial">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="data_final">Data Final</label>
                                        <input type="date" id="data_final" value="{{ request()->get('data_final') }}"
                                            class="form-control" name="data_final">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="product_id">Produto</label>
                                        <select type="text" id="product_id" value="{{ old('product_id') }}"
                                            class="form-control @error('product_id') is-invalid @enderror" name="product_id"
                                            placeholder="Selecione o produto">
                                            <option value="">Todos</option>
                                            @foreach ($products as $product)
                                                <option
                                                    {{ request()->get('product_id') == $product->id ? 'selected' : '' }}
                                                    value="{{ $product->id }}">{{ $product->sku }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
                        <a href="{{ route('reports') }}" class="btn btn-outline-primary mt-3">Limpar</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Produto</th>
                                <th>SKU</th>
                                <th>Quantidade Movimentada</th>
                                <th>Tipo de Movimentação</th>
                                <th>Via</th>
                                <th>Data da movimentação</th>
                            </thead>
                            <tbody>
                                @foreach ($movements as $movement)
                                    <tr>
                                        <td>{{ $movement->product->name }}</td>
                                        <td>{{ $movement->product->sku }}</td>
                                        <td style="color: {{$movement->typeMovement->name == 'Saída' ? 'red' : 'green'}};">{{ $movement->amount }}</td>
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
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        Produtos Com Estoque Baixo
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Produto</th>
                                <th>SKU</th>
                                <th>Quantidade Atual</th>
                            </thead>
                            <tbody>
                                @foreach ($productsAlert as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->inventory->current_amount }}</td>
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
