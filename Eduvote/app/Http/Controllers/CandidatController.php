<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Filiere;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    public function index()
    {
        $candidats = Candidat::with('filiere')->get();
        return view('candidats.index', compact('candidats'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        return view('candidats.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'programme' => 'required',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        Candidat::create($request->all());
        return redirect()->route('candidats.index')->with('success', 'Candidat créé avec succès.');
    }

    public function edit(Candidat $candidat)
    {
        $filieres = Filiere::all();
        return view('candidats.edit', compact('candidat', 'filieres'));
    }

    public function update(Request $request, Candidat $candidat)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'programme' => 'required',
            'filiere_id' => 'required|exists:filieres,id',
        ]);

        $candidat->update($request->all());
        return redirect()->route('candidats.index')->with('success', 'Candidat mis à jour avec succès.');
    }

    public function destroy(Candidat $candidat)
    {
        $candidat->delete();
        return redirect()->route('candidats.index')->with('success', 'Candidat supprimé avec succès.');
    }
}
