<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Profil Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #0ea5e9;
            --accent-color: #8b5cf6;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
        }

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
            font-family: 'Inter', sans-serif;
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
            border-bottom: 2px solid rgba(79, 70, 229, 0.1);
        }

        .header-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-title i {
            font-size: 2rem;
            color: var(--primary-color);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .btn-back {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(79, 70, 229, 0.3);
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            color: white;
        }

        .profile-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2.5rem;
            margin: 2rem auto;
            max-width: 800px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .profile-info h2 {
            font-size: 1.5rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .profile-info p {
            color: #666;
            margin-bottom: 0;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(79, 70, 229, 0.2);
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            background: white;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .academic-info {
            background: rgba(79, 70, 229, 0.05);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .academic-info .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .academic-info .info-item i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .academic-info .info-item:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="header-title">
                    <i class="bi bi-person-badge-fill"></i>
                    Mon Profil Étudiant
                </h1>
                <div>
                    <a href="{{ route('welcome') }}" class="btn btn-back me-2">
                        <i class="bi bi-house-fill me-1"></i>
                        Retour à l'accueil
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-back">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="profile-section">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="profile-info">
                    <h2>{{ auth()->user()->name }}</h2>
                    <p class="text-muted">Étudiant</p>
                </div>
            </div>

            <div class="academic-info">
                <h3 class="section-title">
                    <i class="bi bi-mortarboard-fill"></i>
                    Informations Académiques
                </h3>
                <div class="info-item">
                    <i class="bi bi-diagram-3-fill"></i>
                    <span><strong>Filière:</strong> {{ auth()->user()->filiere ? auth()->user()->filiere->nom : '' }}</span>
                </div>
                <div class="info-item">
                    <i class="bi bi-building-fill"></i>
                    <span><strong>Département:</strong> {{ auth()->user()->departement ? auth()->user()->departement->nom : '' }}</span>
                </div>
            </div>

            <form action="{{ route('etudiant.profile.update') }}" method="POST" class="row g-3">
                @csrf
                @method('patch')
                
                <div class="col-12">
                    <label class="form-label">
                        <i class="bi bi-person-fill"></i>
                        Nom complet
                    </label>
                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                </div>
                
                <div class="col-12">
                    <label class="form-label">
                        <i class="bi bi-envelope-fill"></i>
                        Email
                    </label>
                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi bi-key-fill"></i>
                        Nouveau mot de passe
                    </label>
                    <input type="password" class="form-control" name="password">
                    <small class="form-text text-muted">Laissez vide pour garder le mot de passe actuel</small>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi bi-key-fill"></i>
                        Confirmer le mot de passe
                    </label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        Mettre à jour mon profil
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
