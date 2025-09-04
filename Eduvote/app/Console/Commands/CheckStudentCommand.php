<?php

namespace App\Console\Commands;

use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Console\Command;

class CheckStudentCommand extends Command
{
    protected $signature = 'check:student {email}';
    protected $description = 'Vérifie les informations d\'un étudiant';

    public function handle()
    {
        $email = $this->argument('email');
        
        $etudiant = Etudiant::where('email', $email)->first();
        $user = User::where('email', $email)->first();

        if ($etudiant) {
            $this->info('Informations de l\'étudiant :');
            $this->table(
                ['ID', 'Nom', 'Prénom', 'Email', 'User ID'],
                [[$etudiant->id, $etudiant->nom, $etudiant->prenom, $etudiant->email, $etudiant->user_id]]
            );
        } else {
            $this->error('Aucun étudiant trouvé avec cet email.');
        }

        if ($user) {
            $this->info('Informations de l\'utilisateur :');
            $this->table(
                ['ID', 'Nom', 'Email', 'Rôle'],
                [[$user->id, $user->name, $user->email, $user->role]]
            );
        } else {
            $this->error('Aucun utilisateur trouvé avec cet email.');
        }
    }
}
