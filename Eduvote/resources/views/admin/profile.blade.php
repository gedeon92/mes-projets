<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Profil Administrateur</title>
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

        .header-title {
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .profile-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .profile-section h3 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .btn-back {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: #4338ca;
            color: white;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #dc2626;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: #4f46e5;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .form-label {
            color: #4b5563;
            font-weight: 500;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="header-title">
                    <i class="bi bi-person-badge-fill"></i>
                    Profil Administrateur
                </h1>
                <div>
                    <a href="{{ route('admin.menu') }}" class="btn btn-back me-2">
                        <i class="bi bi-grid-fill me-1"></i>
                        Menu Principal
                    </a>
                    <a href="{{ route('welcome') }}" class="btn btn-back me-2">
                        <i class="bi bi-house-door-fill me-1"></i>
                        Retour dans la Page d'Accueil
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
            <h3>
                <i class="bi bi-pencil-square"></i>
                Modifier mes informations
            </h3>
            <form action="{{ route('admin.profile.update') }}" method="POST" class="row g-3">
                @csrf
                @method('PATCH')
                
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi bi-person-fill"></i>
                        Nom
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi bi-envelope-fill"></i>
                        Email
                    </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi bi-key-fill"></i>
                        Nouveau mot de passe
                    </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                        Mettre à jour le profil
                    </button>
                </div>
            </form>

            <hr class="my-4">

            <div class="text-danger">
                <h4 class="h5 mb-3">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Zone Dangereuse
                </h4>
                <form action="{{ route('admin.profile.destroy') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">
                    @csrf
                    @method('delete')
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-shield-lock-fill"></i>
                            Mot de passe actuel
                        </label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash-fill me-1"></i>
                        Supprimer mon compte
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
