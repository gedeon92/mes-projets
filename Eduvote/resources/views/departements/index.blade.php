<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Liste des Départements</title>
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

        .table {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
        }

        .table th {
            border: none;
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .table tbody tr:hover {
            background: rgba(52, 152, 219, 0.05);
        }

        .btn-add {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
            color: white;
        }

        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: linear-gradient(135deg, #f1c40f, #f39c12);
            border: none;
            color: white;
        }

        .btn-delete {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            border: none;
            color: white;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            color: white;
        }

        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: none;
            background: rgba(46, 204, 113, 0.1);
            border-left: 4px solid #2ecc71;
            color: #27ae60;
        }

        .stats-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            color: #95a5a6;
            opacity: 0.5;
        }

        .empty-state h4 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #7f8c8d;
            margin-bottom: 2rem;
        }

        .badge-departement {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="bi bi-building me-2"></i>
                    Gestion des Départements
                </h1>
                <div>
                    <a href="{{ route('admin.menu') }}" class="btn btn-outline-primary me-2">
                        <i class="bi bi-grid-fill me-1"></i>
                        Menu Principal
                    </a>
                    <a href="{{ route('departements.create') }}" class="btn btn-add">
                        <i class="bi bi-plus-circle me-1"></i>
                        Ajouter un Département
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-building text-success me-3" style="font-size: 2.5rem;"></i>
                        <div>
                            <h3 class="h2 mb-1">{{ $departements->count() }}</h3>
                            <p class="text-muted mb-0">Départements Actifs</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-people-fill text-primary me-3" style="font-size: 2.5rem;"></i>
                        <div>
                            <h3 class="h2 mb-1">{{ $departements->sum('etudiants_count') ?? 0 }}</h3>
                            <p class="text-muted mb-0">Étudiants Inscrits</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="content-card">
            @if($departements->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>Nom du Département</th>
                                <th class="text-center" style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departements as $departement)
                                <tr>
                                    <td>{{ $departement->id }}</td>
                                    <td>
                                        <span class="badge-departement">
                                            {{ $departement->nom }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('departements.edit', $departement->id) }}" 
                                           class="btn btn-action btn-edit btn-sm me-1"
                                           title="Modifier">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('departements.destroy', $departement->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-action btn-delete btn-sm"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce département ?');"
                                                    title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-building"></i>
                    <h4>Aucun département enregistré</h4>
                    <p>Commencez par ajouter un nouveau département.</p>
                    <a href="{{ route('departements.create') }}" class="btn btn-add">
                        <i class="bi bi-plus-circle me-1"></i>
                        Ajouter un Département
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>