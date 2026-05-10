<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auteur;
use App\Models\Livre;

class AuteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auteurs = Auteur::all();
        $livres  = Livre::all();
        return view('auteurs.index', compact('auteurs', 'livres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auteurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // ✅ Champs obligatoires
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            // ✅ Champs optionnels
            'nationalite'    => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'biographie'     => 'nullable|string',
            'email'          => 'nullable|email|unique:auteurs,email|max:255',
            'telephone'      => 'nullable|string|max:20',
        ]);

        $auteur = new Auteur();
        $auteur->nom            = $request->input('nom');
        $auteur->prenom         = $request->input('prenom');
        // ✅ AJOUTÉ
        $auteur->nationalite    = $request->input('nationalite');
        $auteur->date_naissance = $request->input('date_naissance');
        $auteur->biographie     = $request->input('biographie');
        $auteur->email          = $request->input('email');
        $auteur->telephone      = $request->input('telephone');

        $auteur->save();

        return redirect()->route('auteurs.index')
                         ->with('success', 'Auteur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ✅ AJOUTÉ : afficher auteur avec ses livres
        $auteur = Auteur::with('livres')->findOrFail($id);

        return view('auteurs.show', compact('auteur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // ✅ AJOUTÉ : récupérer auteur avec ses livres
        $auteur = Auteur::with('livres')->findOrFail($id);

        return view('auteurs.edit', compact('auteur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $auteur = Auteur::findOrFail($id);

        $request->validate([
            // ✅ Champs obligatoires
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            // ✅ Champs optionnels
            'nationalite'    => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'biographie'     => 'nullable|string',
            'email'          => 'nullable|email|unique:auteurs,email,' . $id . '|max:255',
            'telephone'      => 'nullable|string|max:20',
        ]);

        // ✅ AJOUTÉ : tous les champs de la table
        $auteur->update([
            'nom'            => $request->input('nom'),
            'prenom'         => $request->input('prenom'),
            'nationalite'    => $request->input('nationalite'),
            'date_naissance' => $request->input('date_naissance'),
            'biographie'     => $request->input('biographie'),
            'email'          => $request->input('email'),
            'telephone'      => $request->input('telephone'),
        ]);

        return redirect()->route('auteurs.show', $auteur->id)
                         ->with('success', 'Auteur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $auteur = Auteur::findOrFail($id);

        // ✅ AJOUTÉ : vérifier si auteur a des livres avant suppression
        if ($auteur->livres->count() > 0) {
            return redirect()->route('auteurs.index')
                             ->with('error', 'Impossible de supprimer cet auteur car il a des livres associés.');
        }

        $auteur->delete();

        return redirect()->route('auteurs.index')
                         ->with('success', 'Auteur supprimé avec succès.');
    }
}