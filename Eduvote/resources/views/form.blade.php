<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .menu-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            padding: 2rem;
            height: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #2c3e50;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .menu-card i {
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }

        /* Étudiants - Rouge */
        .menu-item-1 .menu-card i {
            color: #e74c3c;
        }
        .menu-item-1 .menu-card:hover {
            background-color: #e74c3c;
        }
        .menu-item-1 .menu-card:hover i,
        .menu-item-1 .menu-card:hover span {
            color: white;
        }

        /* Candidats - Vert */
        .menu-item-2 .menu-card i {
            color: #2ecc71;
        }
        .menu-item-2 .menu-card:hover {
            background-color: #2ecc71;
        }
        .menu-item-2 .menu-card:hover i,
        .menu-item-2 .menu-card:hover span {
            color: white;
        }

        /* Départements - Orange */
        .menu-item-3 .menu-card i {
            color: #f39c12;
        }
        .menu-item-3 .menu-card:hover {
            background-color: #f39c12;
        }
        .menu-item-3 .menu-card:hover i,
        .menu-item-3 .menu-card:hover span {
            color: white;
        }

        /* Filières - Bleu */
        .menu-item-4 .menu-card i {
            color: #3498db;
        }
        .menu-item-4 .menu-card:hover {
            background-color: #3498db;
        }
        .menu-item-4 .menu-card:hover i,
        .menu-item-4 .menu-card:hover span {
            color: white;
        }

        /* Résultats - Violet */
        .menu-item-5 .menu-card i {
            color: #9b59b6;
        }
        .menu-item-5 .menu-card:hover {
            background-color: #9b59b6;
        }
        .menu-item-5 .menu-card:hover i,
        .menu-item-5 .menu-card:hover span {
            color: white;
        }

        .menu-card span {
            font-size: 1.2rem;
            font-weight: 600;
            text-align: center;
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        .btn-back {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4f46e5;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            z-index: 1000;
        }

        .btn-back:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
            color: white;
        }

        .page-title {
            color: #2c3e50;
            text-align: left;
            margin-bottom: 3rem;
            margin-left: 2rem;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .container {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.17);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>
<body>
   

    <div class="container">
    <a href="{{ route('welcome') }}" class="btn-back">
        <i class="bi bi-house-door-fill"></i>
        Retour à l'accueil
    </a>
        <h1 class="page-title">Menu Principal</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-4 menu-item-1">
                <a href="{{ route('etudiants.index') }}" class="menu-card">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span>Gestion des Étudiants</span>
                </a>
            </div>
            <div class="col-md-4 menu-item-2">
                <a href="{{ route('candidats.index') }}" class="menu-card">
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Gestion des Candidats</span>
                </a>
            </div>
            <div class="col-md-4 menu-item-3">
                <a href="{{ route('departements.index') }}" class="menu-card">
                    <i class="bi bi-building"></i>
                    <span>Gestion des Départements</span>
                </a>
            </div>
            <div class="col-md-4 menu-item-4">
                <a href="{{ route('filieres.index') }}" class="menu-card">
                    <i class="bi bi-diagram-3-fill"></i>
                    <span>Gestion des Filières</span>
                </a>
            </div>
            <div class="col-md-4 menu-item-5">
                <a href="{{ route('votes.results') }}" class="menu-card">
                    <i class="bi bi-bar-chart-fill"></i>
                    <span>Résultats des Votes</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
