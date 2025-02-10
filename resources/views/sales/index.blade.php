
@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Productos Destacados</h2>
                <div class="btn-group">
                    <button class="btn btn-outline-secondary">
                        <i class="fas fa-filter me-1"></i>Filtrar
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="fas fa-sort me-1"></i>Ordenar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        @foreach($sales as $sale)
            <div class="col-md-3">
                <div class="card h-100">
                    @if($sale->images->count() > 0)
                        <img src="{{ asset('storage/' . $sale->images->first()->route) }}" 
                             class="card-img-top" 
                             alt="{{ $sale->product }}" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="fas fa-image fa-2x text-white"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-truncate">{{ $sale->product }}</h5>
                        <p class="price-tag mb-2">{{ number_format($sale->price, 2) }}€</p>
                        <p class="card-text text-muted small">{{ Str::limit($sale->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary">{{ $sale->category->name }}</span>
                            <div>
                                <button class="btn btn-sm btn-outline-danger me-1">
                                    <i class="far fa-heart"></i>
                                </button>
                                <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-custom">Ver más</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <small class="text-muted">
                            <i class="fas fa-map-marker-alt me-1"></i>Madrid
                            <i class="fas fa-clock ms-2 me-1"></i>{{ $sale->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $sales->links() }}
    </div>
@endsection