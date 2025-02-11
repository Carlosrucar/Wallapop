<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $user_id = 1; 
        $conversations = Message::where('sender_id', $user_id)
            ->orWhere('receiver_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('sale_id');
            
        return view('messages.show', compact('messages', 'sale', 'user'));
    }

    public function show(Sale $sale, User $user)
    {
        $current_user_id = 1; 
        
        $messages = Message::where(function($query) use ($current_user_id, $user, $sale) {
            $query->where('sender_id', $current_user_id)
                  ->where('receiver_id', $user->id)
                  ->where('sale_id', $sale->id);
        })->orWhere(function($query) use ($current_user_id, $user, $sale) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $current_user_id)
                  ->where('sale_id', $sale->id);
        })->orderBy('created_at', 'asc')
          ->get();

        return view('messages.show', compact('messages', 'sale', 'user'));
    }

    public function store(Request $request, Sale $sale, User $user)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        Message::create([
            'sender_id' => 1,
            'receiver_id' => $user->id,
            'sale_id' => $sale->id,
            'content' => $request->content
        ]);

        return back()->with('success', 'Mensaje enviado');
    }
}