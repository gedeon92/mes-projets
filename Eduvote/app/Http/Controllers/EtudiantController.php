<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::with(['filiere', 'departement'])->get();
        return view('etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        $departements = Departement::all();
        return view('etudiants.create', compact('filieres', 'departements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'filiere_id' => 'required|exists:filieres,id',
            'departement_id' => 'required|exists:departements,id',
        ]);

        try {
            DB::beginTransaction();

            // Créer l'utilisateur
            $user = User::create([
                'name' => $request->nom . ' ' . $request->prenom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'etudiant'
            ]);

            // Créer l'étudiant
            Etudiant::create([
                'user_id' => $user->id,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'filiere_id' => $request->filiere_id,
                'departement_id' => $request->departement_id
            ]);

            DB::commit();

            return redirect()->route('etudiants.index')
                           ->with('success', 'Étudiant créé avec succès');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Erreur lors de la création de l\'étudiant', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Une erreur est survenue lors de la création de l\'étudiant')
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $filieres = Filiere::all();
        $departements = Departement::all();
        return view('etudiants.edit', compact('etudiant', 'filieres', 'departements'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'filiere_id' => 'required|exists:filieres,id',
            'departement_id' => 'required|exists:departements,id',
            'password' => 'nullable|min:8|confirmed',
        ]);

        try {
            DB::beginTransaction();

            // Mettre à jour l'utilisateur
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->nom . ' ' . $request->prenom,
                'email' => $request->email
            ]);

            // Mettre à jour l'étudiant
            $etudiant = Etudiant::findOrFail($id);
            $etudiant->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'filiere_id' => $request->filiere_id,
                'departement_id' => $request->departement_id
            ]);

            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            DB::commit();

            return redirect()->route('etudiants.index')
                           ->with('success', 'Étudiant mis à jour avec succès');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Erreur lors de la mise à jour de l\'étudiant', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour de l\'étudiant')
                        ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Supprimer l'utilisateur (cela supprimera aussi l'étudiant grâce à la relation)
            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();

            return redirect()->route('etudiants.index')
                           ->with('success', 'Étudiant supprimé avec succès');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Erreur lors de la suppression de l\'étudiant', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Une erreur est survenue lors de la suppression de l\'étudiant');
        }
    }
}
