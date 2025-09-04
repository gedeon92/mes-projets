<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Modifier un Candidat</title>
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

        .content-card {
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
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
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
            box-shadow: 0 5px 15px rgba(241, 196, 15, 0.3);
        }

        .btn-back {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            color: white;
        }

        .form-section {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .form-section-title {
            color: #2c3e50;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(52, 152, 219, 0.2);
        }

        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: none;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            border-left: 4px solid #2ecc71;
            color: #27ae60;
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            border-left: 4px solid #e74c3c;
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="bi bi-person-gear me-2"></i>
                    Modifier le Candidat
                </h1>
                <a href="{{ route('candidats.index') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-card">
            <form action="{{ route('candidats.update', $candidat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="bi bi-person me-2"></i>
                        Informations Personnelles
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom', $candidat->nom) }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                   id="prenom" name="prenom" value="{{ old('prenom', $candidat->prenom) }}" required>
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="bi bi-mortarboard me-2"></i>
                        Informations Académiques
                    </h3>
                    <div class="mb-3">
                        <label for="programme" class="form-label">Programme Electoral</label>
                        <textarea class="form-control @error('programme') is-invalid @enderror" 
                                id="programme" name="programme" rows="4" required>{{ old('programme', $candidat->programme) }}</textarea>
                        @error('programme')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="filiere_id" class="form-label">Filière</label>
                        <select class="form-select @error('filiere_id') is-invalid @enderror" 
                                id="filiere_id" name="filiere_id" required>
                            <option value="">Sélectionnez une filière</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" 
                                        {{ old('filiere_id', $candidat->filiere_id) == $filiere->id ? 'selected' : '' }}>
                                    {{ $filiere->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('filiere_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-check-circle me-1"></i>
                        Mettre à jour le Candidat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>