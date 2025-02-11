
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mis Conversaciones</h2>
    
    <div class="row">
        <div class="col-md-12">
            @forelse($conversations as $sale_id => $messages)
                @php
                    $last_message = $messages->first();
                    $sale = $last_message->sale;
                    $other_user = $last_message->sender_id == 1 ? $last_message->receiver : $last_message->sender;
                @endphp
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                @if($sale->images->count() > 0)
                                    <img src="{{ asset('storage/' . $sale->images->first()->route) }}" 
                                         alt="{{ $sale->product }}" 
                                         class="rounded" 
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">{{ $sale->product }}</h5>
                                <p class="mb-1">{{ $other_user->name }}</p>
                                <p class="text-muted small mb-0">
                                    Último mensaje: {{ $last_message->created_at->diffForHumans() }}
                                </p>
                                <a href="{{ route('messages.show', ['sale' => $sale, 'user' => $other_user]) }}" 
                                   class="btn btn-custom btn-sm mt-2">
                                    Ver conversación
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    No tienes conversaciones activas.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection