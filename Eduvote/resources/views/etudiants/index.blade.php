<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Liste des Étudiants</title>
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

        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
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

        .badge {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-filiere {
            background: linear-gradient(135deg, #3498db, #2980b9);
        }

        .badge-departement {
            background: linear-gradient(135deg, #9b59b6, #8e44ad);
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

        .stats-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-icon.blue {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }

        .stats-icon.purple {
            background: linear-gradient(135deg, #9b59b6, #8e44ad);
            color: white;
        }

        .stats-value {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: #7f8c8d;
            font-size: 0.9rem;
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
                    <i class="bi bi-people-fill me-2"></i>
                    Gestion des Étudiants
                </h1>
                <div>
                <a href="{{ route('admin.menu') }}" class="btn btn-outline-primary me-2">
                        <i class="bi bi-grid-fill me-1"></i>
                        Menu Principal
                    </a>
                    <a href="{{ route('etudiants.create') }}" class="btn btn-add">
                        <i class="bi bi-plus-circle me-1"></i>
                        Ajouter un Étudiant
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
                    <div class="stats-icon blue">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stats-value">{{ $etudiants->count() }}</div>
                    <div class="stats-label">Étudiants Inscrits</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stats-card">
                    <div class="stats-icon purple">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <div class="stats-value">{{ $etudiants->groupBy('filiere_id')->count() }}</div>
                    <div class="stats-label">Filières Actives</div>
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
            @if($etudiants->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>Nom et Prénom</th>
                                <th>Email</th>
                                <th>Filière</th>
                                <th>Département</th>
                                <th class="text-center" style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($etudiants as $etudiant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                                    <td>{{ $etudiant->email }}</td>
                                    <td>
                                        <span class="badge badge-filiere">
                                            {{ $etudiant->filiere->nom ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-departement">
                                            {{ $etudiant->departement->nom ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('etudiants.edit', $etudiant->id) }}" 
                                           class="btn btn-action btn-edit btn-sm me-1"
                                           title="Modifier">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('etudiants.destroy', $etudiant->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-action btn-delete btn-sm"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');"
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
                    <i class="bi bi-people"></i>
                    <h4>Aucun étudiant enregistré</h4>
                    <p>Commencez par ajouter un nouvel étudiant pour gérer vos inscriptions.</p>
                    <a href="{{ route('etudiants.create') }}" class="btn btn-add">
                        <i class="bi bi-plus-circle me-1"></i>
                        Ajouter un Étudiant
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>