@extends('layouts.app')

@section('content')
<div class="row">
    @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($product->images->count() > 0)
                    <img src="{{ asset('storage/' . $product->images->first()->route) }}" class="card-img-top"
                        alt="{{ $product->product }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                        style="height: 200px;">
                        <i class="fas fa-image fa-2x text-white"></i>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title text-truncate">{{ $product->product }}</h5>
                    <p class="price-tag mb-2">{{ number_format($product->price, 2) }}€</p>
                    <p class="card-text text-muted small">{{ Str::limit($product->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-secondary">{{ $product->category->name }}</span>
                        <div>
                            <button class="btn btn-sm btn-outline-danger me-1">
                                <i class="far fa-heart"></i>
                            </button>
                            <a href="{{ route('sales.show', $product) }}" class="btn btn-sm btn-custom">Ver más</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <small class="text-muted">
                        <i class="fas fa-map-marker-alt me-1"></i>Madrid
                        <i class="fas fa-clock ms-2 me-1"></i>{{ $product->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $products->links() }}
</div>
@endsection