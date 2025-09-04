<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Vote des Étudiants</title>
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

        .vote-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-select {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 1rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }

        .form-select option {
            background: white;
            color: #2c3e50;
            padding: 1rem;
        }

        .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
            outline: none;
        }

        .form-control {
            background-color: white !important;
            color: #2c3e50 !important;
            font-size: 1.1rem;
            padding: 1rem;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
            outline: none;
        }

        .form-control option {
            background-color: white;
            color: #2c3e50;
            padding: 0.5rem;
        }

        .form-label {
            color: #2c3e50;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .vote-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .vote-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .vote-button:disabled {
            background: #95a5a6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .info-icon {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 1rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-weight: 500;
            text-align: center;
        }

        .alert-success {
            background-color: rgba(46, 204, 113, 0.2);
            color: #27ae60;
            border: 1px solid rgba(46, 204, 113, 0.3);
        }

        .alert-error {
            background-color: rgba(231, 76, 60, 0.2);
            color: #c0392b;
            border: 1px solid rgba(231, 76, 60, 0.3);
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
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Vote des Étudiants
                </h1>
                <a href="{{ route('welcome') }}" class="btn btn-back">
                    <i class="bi bi-house-fill me-1"></i>
                    Accueil
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-card">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if (!$hasVoted)
                <div class="vote-form">
                    <h2 class="text-center mb-4">Choisissez votre représentant</h2>
                    <form action="{{ route('vote.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="candidat_id" class="form-label mb-2">Sélectionnez un candidat :</label>
                            <select name="candidat_id" id="candidat_id" class="form-control form-control-lg" required>
                                <option value="" selected disabled>-- Choisir un candidat --</option>
                                @forelse ($candidates as $candidate)
                                    <option value="{{ $candidate->id }}">
                                        {{ $candidate->nom }} {{ $candidate->prenom }} - {{ optional($candidate->filiere)->name }}
                                    </option>
                                @empty
                                    <option disabled>Aucun candidat disponible</option>
                                @endforelse
                            </select>
                            @error('candidat_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="vote-button mt-4">
                            <i class="bi bi-check2-circle me-2"></i>
                            Voter maintenant
                        </button>
                    </form>
                </div>
            @else
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Vous avez déjà voté. Merci de votre participation !
                </div>
            @endif
        </div>

        <div class="info-grid">
            <div class="info-card">
                <i class="bi bi-shield-lock-fill info-icon"></i>
                <h3 class="h5 mb-2">Vote Sécurisé</h3>
                <p class="text-muted mb-0">Votre vote est anonyme et sécurisé</p>
            </div>

            <div class="info-card">
                <i class="bi bi-person-check-fill info-icon"></i>
                <h3 class="h5 mb-2">Vote Unique</h3>
                <p class="text-muted mb-0">Un seul vote par étudiant</p>
            </div>

            <div class="info-card">
                <i class="bi bi-graph-up info-icon"></i>
                <h3 class="h5 mb-2">Résultats Instantanés</h3>
                <p class="text-muted mb-0">Les résultats sont mis à jour en temps réel</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>