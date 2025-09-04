<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Tableau de Bord Étudiant</title>
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
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            backdrop-filter: blur(8px);
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-card {
            background: linear-gradient(135deg, #4f46e5, #0ea5e9);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .stat-card i {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .stat-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            margin-bottom: 0;
            opacity: 0.9;
        }

        .action-button {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.2);
            color: white;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .welcome-section h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .welcome-section p {
            color: #34495e;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="bi bi-grid-fill me-2"></i>
                    Tableau de Bord Étudiant
                </h1>
                <div>
                    <a href="{{ route('etudiant.profile') }}" class="btn btn-outline-primary me-2">
                        <i class="bi bi-person-circle me-1"></i>
                        Mon Profil
                    </a>
                    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-house-door-fill me-1"></i>
                        Accueil
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="welcome-section">
            <h1>Bienvenue, {{ auth()->user()->prenom }} !</h1>
            <p>Gérez vos votes et suivez les élections en cours depuis votre espace personnel.</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="stat-card">
                    <i class="bi bi-check-circle-fill"></i>
                    <h3>Votes Effectués</h3>
                    <p>{{ auth()->user()->votes->count() }} vote(s)</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <i class="bi bi-calendar-event-fill"></i>
                    <h3>Élections en Cours</h3>
                    <p>{{ $elections_count ?? 0 }} élection(s)</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <i class="bi bi-person-badge-fill"></i>
                    <h3>Candidats</h3>
                    <p>{{ $candidats_count ?? 0 }} candidat(s)</p>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <h2 class="h4 mb-4">Actions Rapides</h2>
            <div class="d-grid gap-3">
                <a href="{{ route('vote.student') }}" class="action-button">
                    <i class="bi bi-check-square-fill me-2"></i>
                    Voter pour les Élections en Cours
                </a>
                <a href="#" class="action-button" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                    <i class="bi bi-graph-up me-2"></i>
                    Voir les Résultats
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
