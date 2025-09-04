<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Departement;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function index()
    {
        $filieres = Filiere::with('departement')->get();
        return view('filieres.index', compact('filieres'));
    }

    public function create()
    {
        $departements = Departement::all();
        return view('filieres.create', compact('departements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:filieres',
            'departement_id' => 'required|exists:departements,id',
        ]);
        Filiere::create($request->all());
        return redirect()->route('filieres.index')->with('success', 'Filière créée avec succès.');
    }

    public function edit(Filiere $filiere)
    {
        $departements = Departement::all();
        return view('filieres.edit', compact('filiere', 'departements'));
    }

    public function update(Request $request, Filiere $filiere)
    {
        $request->validate([
            'nom' => 'required|unique:filieres,nom,' . $filiere->id,
            'departement_id' => 'required|exists:departements,id',
        ]);
        $filiere->update($request->all());
        return redirect()->route('filieres.index')->with('success', 'Filière mise à jour.');
    }

    public function destroy(Filiere $filiere)
    {
        $filiere->delete();
        return redirect()->route('filieres.index')->with('success', 'Filière supprimée.');
    }
}
