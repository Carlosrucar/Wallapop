@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($sales as $sale)
            <div class="col-md-3 mb-4">
                <div class="card">
                    @if($sale->image)
                        <img src="{{ Storage::url($sale->image) }}" class="card-img-top" alt="{{ $sale->product }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $sale->product }}</h5>
                        <p class="card-text text-success fw-bold">{{ number_format($sale->price, 2) }}€</p>
                        <p class="card-text">{{ Str::limit($sale->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $sale->category->name }}</small>
                            <a href="{{ route('sales.show', $sale) }}" class="btn btn-primary btn-sm">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $sales->links() }}
    </div>
@endsection