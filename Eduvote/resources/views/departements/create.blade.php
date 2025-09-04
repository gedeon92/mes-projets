<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Créer un Département</title>
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

        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
            border-color: #3498db;
        }

        .btn-submit {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
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
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="bi bi-building-add me-2"></i>
                    Créer un Nouveau Département
                </h1>
                <a href="{{ route('departements.index') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-card">
            <form action="{{ route('departements.store') }}" method="POST">
                @csrf

                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="bi bi-building me-2"></i>
                        Informations du Département
                    </h3>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom du Département</label>
                        <input type="text" 
                               class="form-control @error('nom') is-invalid @enderror" 
                               id="nom" 
                               name="nom" 
                               value="{{ old('nom') }}" 
                               required
                               placeholder="Ex: Informatique">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted">
                            Entrez le nom complet du département.
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-check-circle me-1"></i>
                        Créer le Département
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>