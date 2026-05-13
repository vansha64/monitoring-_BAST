<main id="main" class="main">
    <style>
    .dashboard-card {
        background: #fff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 35px -10px rgba(0,0,0,0.15);
    }
    .card-icon {
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .bg-soft-blue { background: #e0f2fe; color: #0369a1; }
    .bg-soft-green { background: #dcfce7; color: #15803d; }
    .bg-soft-purple { background: #f3e8ff; color: #7e22ce; }
    .bg-soft-orange { background: #ffedd5; color: #c2410c; }
    .bg-soft-red { background: #fee2e2; color: #b91c1c; }
    
    .card-title-text { font-size: 0.875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.025em; margin-bottom: 0.25rem; }
    .card-value { font-size: 1.875rem; font-weight: 700; color: #1e293b; margin: 0; }
    
    .main-container {
        background-color: #fff;
        padding: 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin-top: 1.5rem;
    }
    </style>

    <div class="pagetitle mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    <div class="row g-4">
        <!-- Total Kontrak -->
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon bg-soft-blue">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <h6 class="card-title-text">Total Kontrak</h6>
                <p class="card-value"><?= $kontrak_stats['total_kontrak']; ?></p>
            </div>
        </div>

        <!-- Total Perusahaan -->
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon bg-soft-green">
                    <i class="bi bi-building"></i>
                </div>
                <h6 class="card-title-text">Perusahaan</h6>
                <p class="card-value"><?= $kontrak_stats['total_perusahaan']; ?></p>
            </div>
        </div>

        <!-- BAST 1 -->
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon bg-soft-purple">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <h6 class="card-title-text">BAST 1</h6>
                <p class="card-value"><?= $summary_counts['total_bast1']; ?></p>
            </div>
        </div>

        <!-- BAST 2 -->
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon bg-soft-orange">
                    <i class="bi bi-check-all"></i>
                </div>
                <h6 class="card-title-text">BAST 2</h6>
                <p class="card-value"><?= $summary_counts['total_bast2']; ?></p>
            </div>
        </div>

        <!-- Pemasangan/Partial -->
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon bg-soft-blue">
                    <i class="bi bi-tools"></i>
                </div>
                <h6 class="card-title-text">Pemasangan</h6>
                <p class="card-value"><?= $summary_counts['total_parsial'] ?? 0; ?></p>
            </div>
        </div>

        <!-- Final Account -->
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon bg-soft-red">
                    <i class="bi bi-wallet2"></i>
                </div>
                <h6 class="card-title-text">Final Account</h6>
                <p class="card-value"><?= $summary_counts['total_final_account']; ?></p>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title m-0 fw-bold"><i class="bi bi-graph-up me-2"></i>Statistik Kontrak per Perusahaan</h5>
        </div>
        <div style="height: 400px; position: relative;">
            <canvas id="kontrakChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const ctx = document.getElementById('kontrakChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode(array_column($kontrak_summary, 'nama_pt')); ?>,
                    datasets: [{
                        label: 'Jumlah Kontrak',
                        data: <?= json_encode(array_column($kontrak_summary, 'jumlah_kontrak')); ?>,
                        backgroundColor: 'rgba(79, 70, 229, 0.6)',
                        borderColor: 'rgb(79, 70, 229)',
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9' }
                        },
                        x: {
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    });
    </script>
</main>

        #data-tabel tbody tr:hover {
            background-color: #e0f2fe !important;
            /* biru muda hover */
        }

        #data-tabel td {
            color: #1e293b !important;
            /* teks gelap */
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
        }

        /* Column ke-4 agar wrap teks */
        #data-tabel th:nth-child(4),
        #data-tabel td:nth-child(4) {
            max-width: 200px;
            min-width: 200px;
            white-space: normal;
        }

        /* Judul & heading */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #1e293b !important;
        }

        /* ====== BUTTONS CERAH ====== */

        /* Base style */
        .btn-3d {
            position: relative;
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            top: 0;
            color: #fff !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            border: none;
        }

        /* Teal button */
        .btn-3d.btn-teal {
            background-color: #14b8a6;
            /* teal-500 */
            box-shadow: 0 3px 0 #0f766e;
            /* lebih gelap */
        }

        .btn-3d.btn-teal:hover {
            background-color: #0d9488;
            transform: translateY(-2px);
            box-shadow: 0 5px 0 #0f766e;
        }

        /* Indigo button */
        .btn-3d.btn-indigo {
            background-color: #4f46e5;
            /* indigo-600 */
            box-shadow: 0 3px 0 #3730a3;
        }

        .btn-3d.btn-indigo:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
            box-shadow: 0 5px 0 #3730a3;
        }

        /* Active state */
        .btn-3d:active {
            top: 2px;
            transform: translateY(0);
            box-shadow: none !important;
        }
</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-black-800">Dashboard Kontrak</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card border-primary shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-primary">Total Kontrak</h6>
                            <h3><?= $kontrak_stats['total_kontrak']; ?></h3>
                        </div>
                        <i class="fas fa-file-contract fa-3x text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-success shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-success">Total Perusahaan</h6>
                            <h3><?= $kontrak_stats['total_perusahaan']; ?></h3>
                        </div>
                        <i class="fas fa-building fa-3x text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <h6 class="text-success">Jumlah BAST 1</h6>
                        <h3><?= $summary_counts['total_bast1']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-warning shadow-sm">
                    <div class="card-body">
                        <h6 class="text-warning">Jumlah BAST 2</h6>
                        <h3><?= $summary_counts['total_bast2']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-danger shadow-sm">
                    <div class="card-body">
                        <h6 class="text-danger">Final Account</h6>
                        <h3><?= $summary_counts['total_final_account']; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-header text-primary">Grafik Kontrak per Perusahaan</div>
            <div class="card-body" style="height: 400px;">
                <canvas id="kontrakChart"></canvas>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var chartEl = document.getElementById('kontrakChart');
        if (chartEl) {
            var ctx = chartEl.getContext('2d');
            var kontrakData = {
            labels: <?= json_encode(array_column($kontrak_summary, 'nama_pt')); ?>,
            datasets: [{
                label: 'Jumlah Kontrak',
                data: <?= json_encode(array_column($kontrak_summary, 'total_kontrak')); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        new Chart(ctx, {
            type: 'bar',
            data: kontrakData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

</main>
