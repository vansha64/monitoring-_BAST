<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard Kontrak</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Total Kontrak Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Kontrak <span>| System</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $kontrak_stats['total_kontrak']; ?></h6>
                                        <span class="text-success small pt-1 fw-bold">Active</span> <span class="text-muted small pt-2 ps-1">contracts</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Total Kontrak Card -->

                    <!-- Total Perusahaan Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Perusahaan <span>| Partners</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $kontrak_stats['total_perusahaan']; ?></h6>
                                        <span class="text-success small pt-1 fw-bold">Verified</span> <span class="text-muted small pt-2 ps-1">companies</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Total Perusahaan Card -->

                    <!-- Summary Counts Row -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">BAST 1 <span>| Summary</span></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success-light">
                                                <i class="bi bi-check-circle text-success"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><?= $summary_counts['total_bast1']; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">BAST 2 <span>| Summary</span></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning-light">
                                                <i class="bi bi-clock text-warning"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><?= $summary_counts['total_bast2']; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Final Account <span>| Summary</span></h5>
                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger-light">
                                                <i class="bi bi-currency-dollar text-danger"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><?= $summary_counts['total_final_account']; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Card -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Grafik Kontrak per Perusahaan <span>| Analytics</span></h5>
                                <!-- Bar Chart -->
                                <div style="min-height: 400px;" class="echart" id="kontrakChart"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Recent Activity or Other Info can go here -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">System Status <span>| Today</span></h5>
                        <div class="activity">
                            <div class="activity-item d-flex">
                                <div class="activite-label">Info</div>
                                <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                                <div class="activity-content">
                                    Database SQLite initialized successfully.
                                </div>
                            </div><!-- End activity item-->
                        </div>
                    </div>
                </div>
            </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('kontrakChart').getContext('2d');
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