@extends('layouts.app')

@section('content')
<div class="btn-group">
    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
        <i class="fas fa-filter me-1"></i>Filtrar
    </button>
    <div class="btn-group">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-sort me-1"></i>Ordenar
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => 'desc']) }}">Más recientes</a></li>
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => 'asc']) }}">Más antiguos</a></li>
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'asc']) }}">Precio más bajo</a></li>
            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'desc']) }}">Precio más alto</a></li>
        </ul>
    </div>
</div>

<div class="collapse mt-3" id="filterCollapse">
    <div class="card card-body">
        <form action="{{ route('sales.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select name="category" class="form-select">
                            <option value="">Todas las categorías</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Precio mínimo</label>
                        <input type="number" name="price_min" class="form-control" value="{{ request('price_min') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Precio máximo</label>
                        <input type="number" name="price_max" class="form-control" value="{{ request('price_max') }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Aplicar filtros</button>
            <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">Limpiar filtros</a>
        </form>
    </div>
</div>

<div class="row g-4">
    @foreach($sales as $sale)
        <div class="col-md-4">
            <div class="card h-100">
                @if($sale->images->count() > 0)
                    <img src="{{ asset('storage/' . $sale->images->first()->route) }}" class="card-img-top"
                        alt="{{ $sale->product }}" style="height: 200px; object-fit: cover;">
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

                    <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="mt-2"
                        onsubmit="return confirm('¿Está seguro que desea eliminar esta publicación?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </button>
                    </form>
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