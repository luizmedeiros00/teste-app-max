@extends('layouts.app')

@section('content')
    <div class="container">
      @include('partials.alerts')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$product->id == null ? 'Novo' : 'Editar'}} Produto</div>
                    <div class="card-body">
                        <form action="{{ $product->id == null ? '/products' : '/products/' . $product->id }}"
                            method="POST">
                            @isset($product->id)
                                {{ method_field('PATCH') }}
                            @endisset
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" id="name" value="{{ old('name', $product->name) }}"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            placeholder="Nome do produto">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="sku">SKU</label>
                                        <input type="text" id="sku" value="{{ old('sku', $product->sku) }}"
                                            class="form-control @error('sku') is-invalid @enderror" name="sku"
                                            placeholder="SKU do produto">
                                        @error('sku')
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
