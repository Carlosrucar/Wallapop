<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        // Obtén el usuario autenticado
        $user = auth()->user();
        return view('account.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Valida los datos
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Otros campos según necesites
        ]);

        // Actualiza la información del usuario
        $user->update($data);

        return redirect()->route('account.index')
            ->with('success', 'Datos actualizados correctamente');
    }
}