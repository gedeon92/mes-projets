<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Modifier un Étudiant</title>
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

        .page-header {
            background: rgba(255, 255, 255, 0.95);
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .form-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            border-color: #3498db;
        }

        .btn-submit {
            background: linear-gradient(135deg, #f1c40f, #f39c12);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
            color: white;
        }

        .btn-cancel {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(149, 165, 166, 0.3);
            color: white;
        }

        .form-section {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: #2c3e50;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .invalid-feedback {
            font-size: 0.875rem;
            color: #e74c3c;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="bi bi-person-gear me-2"></i>
                    Modifier l'Étudiant
                </h1>
                <a href="{{ route('etudiants.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-card">
                    <form method="POST" action="{{ route('etudiants.update', $etudiant->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Informations Personnelles -->
                        <div class="form-section">
                            <h2 class="section-title">
                                <i class="bi bi-person-badge"></i>
                                Informations Personnelles
                            </h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" 
                                           class="form-control @error('nom') is-invalid @enderror" 
                                           id="nom" 
                                           name="nom" 
                                           value="{{ old('nom', $etudiant->nom) }}"
                                           required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" 
                                           class="form-control @error('prenom') is-invalid @enderror" 
                                           id="prenom" 
                                           name="prenom" 
                                           value="{{ old('prenom', $etudiant->prenom) }}"
                                           required>
                                    @error('prenom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informations de Contact -->
                        <div class="form-section">
                            <h2 class="section-title">
                                <i class="bi bi-envelope"></i>
                                Informations de Contact
                            </h2>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $etudiant->email) }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Informations Académiques -->
                        <div class="form-section">
                            <h2 class="section-title">
                                <i class="bi bi-mortarboard"></i>
                                Informations Académiques
                            </h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="filiere_id" class="form-label">Filière</label>
                                    <select class="form-select @error('filiere_id') is-invalid @enderror" 
                                            id="filiere_id" 
                                            name="filiere_id" 
                                            required>
                                        <option value="">Sélectionner une filière</option>
                                        @foreach($filieres as $filiere)
                                            <option value="{{ $filiere->id }}" 
                                                    {{ old('filiere_id', $etudiant->filiere_id) == $filiere->id ? 'selected' : '' }}>
                                                {{ $filiere->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('filiere_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="departement_id" class="form-label">Département</label>
                                    <select class="form-select @error('departement_id') is-invalid @enderror" 
                                            id="departement_id" 
                                            name="departement_id" 
                                            required>
                                        <option value="">Sélectionner un département</option>
                                        @foreach($departements as $departement)
                                            <option value="{{ $departement->id }}"
                                                    {{ old('departement_id', $etudiant->departement_id) == $departement->id ? 'selected' : '' }}>
                                                {{ $departement->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('departement_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('etudiants.index') }}" class="btn btn-cancel">
                                <i class="bi bi-x-circle me-1"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-submit">
                                <i class="bi bi-check-circle me-1"></i>
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>