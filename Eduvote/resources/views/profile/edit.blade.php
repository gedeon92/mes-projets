<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Mon Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(45deg,
                rgba(255, 255, 255, 0.9) 0%,
                rgba(34, 197, 94, 0.6) 30%,
                rgba(0, 0, 0, 0.7) 60%,
                rgba(255, 255, 255, 0.8) 100%
            );
            background-size: 300% 300%;
            animation: gradient 15s ease infinite;
            min-height: 100vh;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .profile-header {
            background: rgba(255, 255, 255, 0.95);
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            color: #2c3e50;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-subtitle {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            border-color: #3498db;
        }

        .btn-profile {
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-save {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            border: none;
            color: white;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            border: none;
            color: white;
        }

        .btn-danger:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .danger-zone {
            border: 1px solid rgba(231, 76, 60, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            background: rgba(231, 76, 60, 0.05);
        }

        .alert {
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            border: 1px solid rgba(46, 204, 113, 0.2);
            color: #27ae60;
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.2);
            color: #c0392b;
        }

        .verification-notice {
            background: rgba(241, 196, 15, 0.1);
            border: 1px solid rgba(241, 196, 15, 0.2);
            color: #f39c12;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .verification-btn {
            background: none;
            border: none;
            color: #3498db;
            text-decoration: underline;
            padding: 0;
            margin: 0;
            cursor: pointer;
        }

        .verification-btn:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="profile-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="card-title mb-0">
                    <i class="bi bi-person-circle"></i>
                    Mon Profil
                </h1>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>
                    Retour au Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>
                        Profil mis à jour avec succès !
                    </div>
                @endif

                <!-- Informations du Profil -->
                <div class="profile-card">
                    <h2 class="card-title">
                        <i class="bi bi-person-badge"></i>
                        Informations Personnelles
                    </h2>
                    <p class="card-subtitle">
                        Mettez à jour vos informations personnelles et votre adresse email.
                    </p>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6">
                        @csrf
                        @method('patch')
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="verification-notice">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Votre adresse email n'est pas vérifiée.
                                <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="verification-btn">
                                        Cliquez ici pour renvoyer l'email de vérification
                                    </button>
                                </form>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-profile btn-save mt-4">
                            <i class="bi bi-check-circle me-2"></i>
                            Sauvegarder les modifications
                        </button>
                    </form>
                </div>

                <!-- Modification du mot de passe -->
                <div class="profile-card">
                    <h2 class="card-title">
                        <i class="bi bi-shield-lock"></i>
                        Sécurité
                    </h2>
                    <p class="card-subtitle">
                        Assurez-vous d'utiliser un mot de passe long et aléatoire pour plus de sécurité.
                    </p>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        
                        <div class="form-group">
                            <label for="current_password" class="form-label">Mot de passe actuel</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-profile btn-save">
                            <i class="bi bi-shield-check me-2"></i>
                            Mettre à jour le mot de passe
                        </button>
                    </form>
                </div>

                <!-- Zone de Danger -->
                <div class="profile-card">
                    <h2 class="card-title text-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                        Zone de Danger
                    </h2>
                    <div class="danger-zone">
                        <h5 class="text-danger mb-3">Supprimer mon compte</h5>
                        <p class="text-muted mb-3">
                            Une fois votre compte supprimé, toutes vos ressources et données seront définitivement effacées.
                            Cette action est irréversible.
                        </p>
                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')
                            
                            <div class="form-group">
                                <label for="delete_password" class="form-label">
                                    Confirmez votre mot de passe pour continuer
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="delete_password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i>
                                Supprimer définitivement mon compte
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>