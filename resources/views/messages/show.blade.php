@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $sale->product }}</h5>
                    <p class="price-tag">{{ number_format($sale->price, 2) }}€</p>
                    @if($sale->images->count() > 0)
                        <img src="{{ asset('storage/' . $sale->images->first()->route) }}" 
                            alt="{{ $sale->product }}" 
                            class="img-fluid rounded mb-3"
                            style="height: 300px; width: 150px; object-fit: cover; display: block; margin: 0 auto;">
                    @endif
                    <div class="text-muted mb-3">
                        <p class="mb-2">
                            <i class="fas fa-clock me-1"></i>
                            {{ $sale->created_at->diffForHumans() }}
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-tag me-1"></i>
                            {{ $sale->category->name }}
                        </p>
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('sales.show', $sale) }}" 
                           class="btn btn-outline-primary w-100">
                            <i class="fas fa-external-link-alt me-1"></i>
                            Ver producto
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" style="height: 400px; overflow-y: auto;">
                    @foreach($messages as $message)
                        <div class="mb-3 d-flex {{ $message->sender_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                            <div class="card {{ $message->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-light' }}" 
                                 style="max-width: 70%;">
                                <div class="card-body py-2 px-3">
                                    <p class="mb-1">{{ $message->content }}</p>
                                    <small class="{{ $message->sender_id == Auth::id() ? 'text-white-50' : 'text-muted' }}">
                                        {{ $message->created_at->format('H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <form action="{{ route('messages.store', ['sale' => $sale, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" 
                                   name="content" 
                                   class="form-control" 
                                   placeholder="Escribe un mensaje..."
                                   required
                                   autocomplete="off">
                            <button type="submit" class="btn btn-custom">
                                <i class="fas fa-paper-plane me-1"></i>
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection