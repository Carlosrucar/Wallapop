@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $sale->product }}</h1>
            @if($sale->images->count() > 0)
                <div class="row mb-3">
                    @foreach($sale->images as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ Storage::url($image->path) }}" class="img-fluid rounded" alt="{{ $sale->product }}">
                        </div>
                    @endforeach
                </div>
            @endif
            <p class="h3 text-success">{{ number_format($sale->price, 2) }}€</p>
            <p>{{ $sale->description }}</p>
            <div class="text-muted">
                <p>Categoría: {{ $sale->category->name }}</p>
                <p>Publicado: {{ $sale->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection