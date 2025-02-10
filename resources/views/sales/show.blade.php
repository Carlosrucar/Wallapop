
@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $sale->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $sale->product }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @forelse($sale->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->route) }}" 
                                     class="d-block w-100" 
                                     alt="{{ $sale->product }}"
                                     style="height: 400px; object-fit: contain;">
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                     style="height: 400px;">
                                    <i class="fas fa-image fa-3x text-white"></i>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @if($sale->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="price-tag mb-3">{{ number_format($sale->price, 2) }}€</h3>
                    <h4 class="card-title">{{ $sale->product }}</h4>
                    <p class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        Publicado {{ $sale->created_at->diffForHumans() }}
                    </p>
                    <hr>
                    <div class="d-grid gap-2">
                        <button class="btn btn-custom btn-lg">
                            <i class="fas fa-comment-alt me-2"></i>Chat con el vendedor
                        </button>
                        <button class="btn btn-outline-danger">
                            <i class="far fa-heart me-2"></i>Añadir a favoritos
                        </button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Descripción</h5>
                    <p class="card-text">{{ $sale->description }}</p>
                    <hr>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/50" class="rounded-circle" alt="User">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">{{ $sale->user->name ?? 'Usuario' }}</h6>
                            <small class="text-muted">Miembro desde {{ $sale->user->created_at->format('M Y') ?? 'hace tiempo' }}</small>
                        </div>
                    </div>
                    <p class="mb-0">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        Madrid, España
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h4>Productos similares</h4>
            <!-- Aquí puedes añadir una lista de productos similares -->
        </div>
    </div>
</div>
@endsection