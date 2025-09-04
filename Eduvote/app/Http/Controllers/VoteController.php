<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function studentVote()
    {
        // Récupérer les candidats
        $candidates = Candidat::with('filiere')->get();
        
        // Vérifier si l'étudiant a déjà voté
        $hasVoted = Vote::where('user_id', Auth::id())->exists();
        
        return view('vote.new-vote', [
            'candidates' => $candidates,
            'hasVoted' => $hasVoted
        ]);
    }

    public function submitVote(Request $request)
    {
        $request->validate([
            'candidat_id' => 'required|exists:candidats,id',
        ]);

        // Vérifier si l'utilisateur a déjà voté
        if (Vote::where('user_id', Auth::id())->exists()) {
            return redirect()->route('welcome')
                ->with('error', 'Vous avez déjà voté.');
        }

        // Récupérer le candidat
        $candidat = Candidat::with('filiere')->findOrFail($request->candidat_id);

        // Enregistrer le vote
        Vote::create([
            'user_id' => Auth::id(),
            'candidat_id' => $request->candidat_id,
        ]);

        return redirect()->route('welcome')
            ->with('success', "Merci d'avoir voté ! Vous avez choisi {$candidat->nom} {$candidat->prenom} comme votre représentant. Votre participation est importante pour notre établissement !");
    }

    public function results()
    {
        // Vérifier si l'utilisateur est admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('welcome')
                ->with('error', 'Accès non autorisé. Seuls les administrateurs peuvent voir les résultats.');
        }

        // Le reste du code pour afficher les résultats...
        $results = Candidat::withCount('votes')
            ->with('filiere')
            ->get();

        return view('vote.results', compact('results'));
    }
}
