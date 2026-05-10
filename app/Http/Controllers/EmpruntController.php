<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprunt;
use App\Models\Livre;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\EmpruntsExport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprunts = Emprunt::with('livre')->get();
        return view('emprunts.index', compact('emprunts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $livres = Livre::all();
        $users = User::all();
        return view('emprunts.create', compact('livres', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'livre_id'     => 'required|integer|exists:livres,id',
            'date_emprunt' => 'required|date',
            'date_retour'  => 'required|date',
            // ✅ AJOUTÉ
            'statut'       => 'nullable|in:en_cours,retourne,en_retard',
            'prolongation' => 'nullable|boolean',
            'notes'        => 'nullable|string',
        ]);

        $emprunt               = new Emprunt();
        $emprunt->livre_id     = $validatedData['livre_id'];
        $emprunt->user_id      = Auth::id();
        $emprunt->date_emprunt = $validatedData['date_emprunt'];
        $emprunt->date_retour  = $validatedData['date_retour'];
        // ✅ AJOUTÉ
        $emprunt->statut       = $validatedData['statut'] ?? 'en_cours';
        $emprunt->prolongation = $request->has('prolongation') ? 1 : 0;
        $emprunt->notes        = $validatedData['notes'] ?? null;

        $emprunt->save();

        return redirect()->route('emprunts.index')
                         ->with('success', 'Emprunt enregistré avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $emprunt = Emprunt::with('livre')->find($id);
        return view('emprunts.show', compact('emprunt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // ✅ AJOUTÉ
        $emprunt = Emprunt::with('livre')->find($id);
        $livres  = Livre::all();
        $users   = User::all();
        return view('emprunts.edit', compact('emprunt', 'livres', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ✅ AJOUTÉ
        $emprunt = Emprunt::findOrFail($id);

        $request->validate([
            'livre_id'     => 'required|integer|exists:livres,id',
            'date_emprunt' => 'required|date',
            'date_retour'  => 'required|date',
            // ✅ AJOUTÉ
            'statut'       => 'nullable|in:en_cours,retourne,en_retard',
            'prolongation' => 'nullable|boolean',
            'notes'        => 'nullable|string',
        ]);

        // ✅ AJOUTÉ
        $emprunt->update([
            'livre_id'     => $request->input('livre_id'),
            'user_id'      => Auth::id(),
            'date_emprunt' => $request->input('date_emprunt'),
            'date_retour'  => $request->input('date_retour'),
            // ✅ AJOUTÉ
            'statut'       => $request->input('statut') ?? 'en_cours',
            'prolongation' => $request->has('prolongation') ? 1 : 0,
            'notes'        => $request->input('notes'),
        ]);

        return redirect()->route('emprunts.index')
                         ->with('success', 'Emprunt mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $emprunt = Emprunt::findOrFail($id);
        $emprunt->delete();
        return redirect()->route('emprunts.index')
                         ->with('success', 'Emprunt annulé avec succès.');
    }

    public function downloadPDF()
    {
        $emprunts = Emprunt::all();
        $pdf = PDF::loadView('emprunts.pdf', compact('emprunts'));
        return $pdf->download('fiche.pdf');
    }

    public function downloadExcel()
    {
        return Excel::download(new EmpruntsExport, 'fiche.xlsx');
    }
}