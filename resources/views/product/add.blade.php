@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.alerts')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Adicionar Produto</div>
                    <div class="card-body">
                        <form action="{{route('movements.adicionar-produto')}}" method="POST">
                        
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="product_id">Produto</label>
                                        <select type="text" id="product_id" value="{{ old('product_id') }}"
                                            class="form-control @error('product_id') is-invalid @enderror" name="product_id"
                                            placeholder="Selecione o produto">
                                            <option value="">Selecione o produto</option>
                                            @foreach ($products as $product)
                                                <option
                                                    {{ old('product_id') == $product->id? 'selected': '' }}
                                                    value="{{ $product->id }}">{{ $product->sku }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="amount">Quantidade</label>
                                        <input type="number" id="amount" value="{{ old('amount') }}"
                                            class="form-control @error('amount') is-invalid @enderror" name="amount"
                                            placeholder="Informe a quantidade que deseja adicionar">
                                        @error('amount')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
