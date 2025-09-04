<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Plateforme de Vote Éducative</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
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

        .dashboard-container {
            padding: 2rem;
            margin-top: 2rem;
        }

        .stats-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #3498db;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: #666;
            font-size: 0.9rem;
        }

        .action-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .welcome-title {
            color: #2c3e50;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .welcome-subtitle {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .action-button {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .action-button.admin {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            border: none;
            color: white;
        }

        .action-button.student {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            border: none;
            color: white;
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-3px);
        }

        .feature-icon {
            font-size: 2rem;
            color: #3498db;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 16L20 8L36 16L20 24L4 16Z" fill="#3498db"/>
                    <path d="M28 18V28C28 28 24 32 20 32C16 32 12 28 12 28V18" stroke="#2c3e50" stroke-width="2"/>
                    <circle cx="20" cy="16" r="4" fill="#2c3e50"/>
                    <path d="M18 16L20 18L22 14" stroke="white" stroke-width="2"/>
                </svg>
                <span>Edu<strong>Vote</strong></span>
            </a>
            <div class="ms-auto">
                @if(auth()->check())
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-btn">
                            <i class="bi bi-gear-fill"></i>
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('etudiant.profile') }}" class="nav-btn">
                            <i class="bi bi-person-circle"></i>
                            Mon Profil
                        </a>
                    @endif
                   
                @else
                    <a href="{{ route('login') }}" class="nav-btn">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Connexion
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container dashboard-container">
        @if (session('success'))
            <div class="alert alert-success" style="background-color: rgba(46, 204, 113, 0.2); color: #27ae60; border: 1px solid rgba(46, 204, 113, 0.3); padding: 1rem; border-radius: 10px; margin-bottom: 2rem; text-align: center; font-weight: 500;">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" style="background-color: rgba(231, 76, 60, 0.2); color: #c0392b; border: 1px solid rgba(231, 76, 60, 0.3); padding: 1rem; border-radius: 10px; margin-bottom: 2rem; text-align: center; font-weight: 500;">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="action-card">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <h1 class="welcome-title">Tableau de Bord Administrateur</h1>
                            <p class="welcome-subtitle">Gérez les votes et suivez les résultats en temps réel</p>
                            <a href="{{ route('admin.menu') }}" class="btn action-button admin">
                                <i class="bi bi-gear-fill me-2"></i>Accéder au gestionnaire
                            </a>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="stats-card">
                                        <i class="bi bi-people-fill stats-icon"></i>
                                        <div class="stats-number">{{ $totalEtudiants ?? 5 }}</div>
                                        <div class="stats-label">Étudiants Inscrits</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stats-card">
                                        <i class="bi bi-check-circle-fill stats-icon"></i>
                                        <div class="stats-number">{{ $totalVotes ?? 3 }}</div>
                                        <div class="stats-label">Votes Effectués</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stats-card">
                                        <i class="bi bi-calendar-event stats-icon"></i>
                                        <div class="stats-number">{{ $votesActifs ?? 6 }}</div>
                                        <div class="stats-label">Votes Actifs</div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h1 class="welcome-title">Espace de Vote Étudiant</h1>
                            <p class="welcome-subtitle">Votre voix compte ! Participez aux décisions de votre établissement</p>
                            
                            @php
                                $hasVoted = \App\Models\Vote::where('user_id', auth()->id())->exists();
                            @endphp

                            @if($hasVoted)
                                <div class="student-status">
                                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                                    <h3 class="mt-3 mb-3">Vous avez déjà voté</h3>
                                    <p class="text-muted">Merci de votre participation !</p>
                                </div>
                            @else
                                <a href="{{ route('vote.student') }}" class="btn action-button student">
                                    <i class="bi bi-check2-circle me-2"></i>Voter Maintenant
                                </a>
                            @endif

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        <i class="bi bi-shield-check feature-icon"></i>
                                        <h3>Vote Sécurisé</h3>
                                        <p>Votre vote est anonyme et protégé</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        <i class="bi bi-person-check feature-icon"></i>
                                        <h3>Vote Unique</h3>
                                        <p>Un seul vote par étudiant</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <h1 class="welcome-title">Bienvenue sur EduVote</h1>
                        <p class="welcome-subtitle">Connectez-vous pour participer au vote</p>
                        <a href="{{ route('login') }}" class="btn action-button student">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Se Connecter
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
