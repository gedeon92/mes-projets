<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduVote - Résultats des Votes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .chart-container {
            position: relative;
            margin: auto;
            height: 400px;
            width: 100%;
        }

        .chart-legend {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 1rem;
            margin-top: 2rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            padding: 0.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .legend-item:hover {
            background: rgba(52, 152, 219, 0.1);
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            margin-right: 1rem;
        }

        .legend-text {
            font-weight: 600;
            color: #2c3e50;
        }

        .legend-value {
            margin-left: auto;
            font-weight: 600;
            color: #27ae60;
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

        .chart-type-buttons {
            margin-bottom: 2rem;
            text-align: center;
        }

        .btn-chart-type {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            padding: 0.5rem 1.5rem;
            margin: 0 0.5rem;
            border-radius: 20px;
            font-weight: 600;
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        .btn-chart-type:hover, .btn-chart-type.active {
            background: #3498db;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        /* Styles pour l'impression */
        @media print {
            body {
                background: none !important;
                padding: 20px !important;
            }

            .no-print {
                display: none !important;
            }

            .content-card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }

            .stats-card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                break-inside: avoid;
            }

            .chart-container {
                break-inside: avoid;
                margin: 20px 0;
            }

            .chart-legend {
                break-inside: avoid;
            }

            .print-header {
                text-align: center;
                margin-bottom: 30px;
            }

            .print-header img {
                max-width: 100px;
                margin-bottom: 10px;
            }

            .print-footer {
                text-align: center;
                margin-top: 30px;
                font-size: 12px;
                color: #666;
            }
        }

        .btn-print {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3);
            color: white;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    Résultats des Votes
                </h1>
                <div>
                    <button onclick="window.print()" class="btn btn-print me-2 no-print">
                        <i class="bi bi-printer-fill me-1"></i>
                        Imprimer les résultats
                    </button>
                    <a href="{{ route('admin.menu') }}" class="btn btn-outline-primary me-2 no-print">
                        <i class="bi bi-grid-fill me-1"></i>
                        Menu Principal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- En-tête pour l'impression -->
        <div class="print-header d-none d-print-block">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mb-3">
            <h1>Résultats des Votes - EduVote</h1>
            <p>Date d'impression : {{ now()->format('d/m/Y H:i') }}</p>
        </div>

        @php
            $totalVotes = $results->sum('votes_count');
            $maxVotes = $results->max('votes_count');
        @endphp

        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-people-fill text-primary me-3" style="font-size: 2.5rem;"></i>
                        <div>
                            <h3 class="h2 mb-1">{{ $results->count() }}</h3>
                            <p class="text-muted mb-0">Candidats</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 2.5rem;"></i>
                        <div>
                            <h3 class="h2 mb-1">{{ $totalVotes }}</h3>
                            <p class="text-muted mb-0">Votes Total</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-trophy-fill text-warning me-3" style="font-size: 2.5rem;"></i>
                        <div>
                            <h3 class="h2 mb-1">{{ $maxVotes }}</h3>
                            <p class="text-muted mb-0">Votes Maximum</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-card">
            @if($results->count() > 0)
                <!-- Boutons de type de graphique -->
                <div class="chart-type-buttons">
                    <button class="btn-chart-type active" data-type="bar">
                        <i class="bi bi-bar-chart-fill me-2"></i>Barres
                    </button>
                    <button class="btn-chart-type" data-type="pie">
                        <i class="bi bi-pie-chart-fill me-2"></i>Camembert
                    </button>
                    <button class="btn-chart-type" data-type="doughnut">
                        <i class="bi bi-circle me-2"></i>Anneau
                    </button>
                </div>

                <!-- Conteneur du graphique -->
                <div class="chart-container">
                    <canvas id="voteChart"></canvas>
                </div>

                <!-- Légende personnalisée -->
                <div class="chart-legend">
                    <div class="row">
                        @foreach($results as $index => $candidate)
                            <div class="col-md-6">
                                <div class="legend-item">
                                    <div class="legend-color" id="legend-color-{{ $index }}"></div>
                                    <span class="legend-text">{{ $candidate->nom }} {{ $candidate->prenom }}</span>
                                    <span class="legend-value">{{ $candidate->votes_count }} votes</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-bar-chart"></i>
                    <h4>Aucun vote enregistré</h4>
                    <p>Les résultats des votes s'afficheront ici une fois que les étudiants auront commencé à voter.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Pied de page pour l'impression -->
    <div class="print-footer d-none d-print-block">
        <p>Document généré par EduVote le {{ now()->format('d/m/Y à H:i') }}</p>
        <p>Page 1</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Données pour le graphique
        const data = {
            labels: {!! json_encode($results->map(function($candidate) {
                return $candidate->nom . ' ' . $candidate->prenom;
            })) !!},
            datasets: [{
                data: {!! json_encode($results->pluck('votes_count')) !!},
                backgroundColor: [
                    'rgba(52, 152, 219, 0.8)',
                    'rgba(46, 204, 113, 0.8)',
                    'rgba(155, 89, 182, 0.8)',
                    'rgba(241, 196, 15, 0.8)',
                    'rgba(231, 76, 60, 0.8)',
                    'rgba(52, 73, 94, 0.8)',
                ],
                borderColor: [
                    'rgba(52, 152, 219, 1)',
                    'rgba(46, 204, 113, 1)',
                    'rgba(155, 89, 182, 1)',
                    'rgba(241, 196, 15, 1)',
                    'rgba(231, 76, 60, 1)',
                    'rgba(52, 73, 94, 1)',
                ],
                borderWidth: 2
            }]
        };

        // Configuration du graphique
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#2c3e50',
                        bodyColor: '#2c3e50',
                        borderColor: 'rgba(0, 0, 0, 0.1)',
                        borderWidth: 1,
                        padding: 15,
                        boxPadding: 10,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                return context.parsed + ' votes';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        };

        // Création du graphique
        const ctx = document.getElementById('voteChart').getContext('2d');
        const chart = new Chart(ctx, config);

        // Mise à jour des couleurs de la légende
        document.querySelectorAll('.legend-color').forEach((el, index) => {
            el.style.backgroundColor = data.datasets[0].backgroundColor[index];
        });

        // Gestion des boutons de type de graphique
        document.querySelectorAll('.btn-chart-type').forEach(button => {
            button.addEventListener('click', function() {
                const type = this.dataset.type;
                
                // Mise à jour de l'apparence des boutons
                document.querySelectorAll('.btn-chart-type').forEach(btn => {
                    btn.classList.remove('active');
                });
                this.classList.add('active');

                // Mise à jour du type de graphique
                chart.config.type = type;
                
                // Ajustement des options selon le type
                if (type === 'bar') {
                    chart.options.scales.y.display = true;
                } else {
                    chart.options.scales.y.display = false;
                }
                
                chart.update();
            });
        });
    </script>
</body>
</html>