<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function show()
    {
        return view('profil');
    }

    public function update(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', // Rendre le mot de passe facultatif
            'profile_image' => 'nullable|string', // Avatar optionnel
        ]);
    
        // Obtenir l'utilisateur authentifié
        $user = Auth::user();
    
        // Mettre à jour le nom de l'utilisateur
        $user->name = $validatedData['name'];
    
        // Mettre à jour le mot de passe s'il est fourni
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
    
        // Mettre à jour l'avatar s'il est sélectionné
        if (!empty($validatedData['avatar'])) {
            $user->avatar = $validatedData['avatar'];
        }
    
        // Sauvegarder les modifications
        $user->save();
    
        // Rediriger l'utilisateur vers la page de profil avec un message de succès
        return redirect()->route('profile.show')->with('success', 'Profil mis à jour avec succès.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
