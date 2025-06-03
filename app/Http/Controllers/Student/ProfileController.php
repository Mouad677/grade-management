<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || auth()->user()->role !== 'student') {
                abort(403, 'Accès non autorisé.');
            }
            return $next($request);
        });
    }

    public function show()
    {
        $user = auth()->user();
        return view('student.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('student.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Ajoutez d'autres champs à valider si besoin
        ]);
        $user->update($data);
        return redirect()->route('student.profile.show')->with('success', 'Profil mis à jour avec succès.');
    }
}
