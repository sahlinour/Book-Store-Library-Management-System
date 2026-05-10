<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Auteur;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::whereNotNull('image_couverture')->get();

        $auteurs = [];
        foreach ($livres as $livre) {
            $auteur = Auteur::find($livre->auteur_id);
            if ($auteur) {
                $auteurs[$livre->id] = $auteur;
            }
            $livre->image_couverture = asset('storage/' . $livre->image_couverture);
        }

        return view('livres.index', compact('livres', 'auteurs'));
    }

    public function create()
    {
        return view('livres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'              => 'required|string',
            // ✅ AJOUTÉ
            'isbn'               => 'nullable|string|unique:livres,isbn',
            'année_publication'  => 'required|numeric',
            'genre'              => 'required|string',
            // ✅ AJOUTÉ
            'description'        => 'nullable|string',
            'résumé'             => 'required|string',
            'langue'             => 'required|string',
            'nombre_exemplaires' => 'required|numeric',
            'nom'                => 'required|string',
            'prenom'             => 'required|string',
            'image_couverture'   => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $livre = new Livre();

        // ✅ AJOUTÉ
        $livre->isbn               = $request->input('isbn');
        $livre->titre              = $request->input('titre');
        $livre->année_publication  = $request->input('année_publication');
        $livre->genre              = $request->input('genre');
        // ✅ AJOUTÉ
        $livre->description        = $request->input('description');
        $livre->résumé             = $request->input('résumé');
        $livre->langue             = $request->input('langue');
        $livre->nombre_exemplaires = $request->input('nombre_exemplaires');

        // Auteur
        $auteur = Auteur::where('nom', $request->nom)->first();
        if ($auteur) {
            $livre->auteur_id = $auteur->id;
        } else {
            $auteur          = new Auteur();
            $auteur->nom     = $request->nom;
            $auteur->prenom  = $request->prenom;
            $auteur->save();
            $livre->auteur_id = $auteur->id;
        }

        // Image
        if ($request->hasFile('image_couverture')) {
            $livre->image_couverture = $request->file('image_couverture')
                                              ->store('images', 'public');
        }

        // Disponible
        $livre->disponible = $request->has('disponible') ? 1 : 0;

        $livre->save();

        return redirect()->route('livres.index')
                         ->with('success', 'Livre créé avec succès.');
    }

    public function show(string $id)
    {
        $livre = Livre::with('auteur')->findOrFail($id);

        return view('livres.show', compact('livre'));
    }

    public function edit(string $id)
    {
        $livre  = Livre::with('auteur')->findOrFail($id);
        $auteurs = [];

        $auteur = Auteur::find($livre->auteur_id);
        if ($auteur) {
            $auteurs[$livre->id] = $auteur;
        }

        return view('livres.edit', compact('livre', 'auteurs'));
    }

    public function update(Request $request, string $id)
    {
        $livre = Livre::findOrFail($id);

        $request->validate([
            'titre'              => 'required|string',
            'isbn'               => 'nullable|string|unique:livres,isbn,' . $id,
            'annee_publication'  => 'required|numeric',
            'genre'              => 'required|string',
            'description'        => 'nullable|string',
            'resume'             => 'required|string',
            'langue'             => 'required|string',
            'nombre_exemplaires' => 'required|numeric',
            'disponible'         => 'required',
            'image_couverture'   => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        // ✅ CORRIGÉ : utiliser fill() au lieu de update()
        // pour pouvoir ajouter l'image avant de sauvegarder
        $livre->fill($request->only([
            'titre',
            'isbn',
            'annee_publication',
            'genre',
            'description',
            'resume'
        ]));
        $livre->langue             = $request->input('langue');
        $livre->nombre_exemplaires = $request->input('nombre_exemplaires');
        $livre->disponible         = $request->input('disponible');

        // ✅ CORRIGÉ : image dans le même bloc avant save()
        if ($request->hasFile('image_couverture')) {
            // Supprimer ancienne image
            if ($livre->image_couverture) {
                Storage::disk('public')->delete($livre->image_couverture);
            }
            $livre->image_couverture = $request->file('image_couverture')
                                            ->store('images', 'public');
        }

        // ✅ UN SEUL save() à la fin pour tout sauvegarder
        $livre->save();

        return redirect()->route('livres.show', $livre->id)
                        ->with('success', 'Livre mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $livre = Livre::findOrFail($id);

        // ✅ AJOUTÉ : supprimer image lors de la suppression
        if ($livre->image_couverture) {
            Storage::disk('public')->delete($livre->image_couverture);
        }

        $livre->delete();

        return redirect()->route('livres.index')
                         ->with('success', 'Livre supprimé avec succès.');
    }
}