<main id="main" class="main">
    <style>
    .main-container {
        background-color: #fff;
        padding: 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.15);
        margin: 0 auto;
        max-width: 100%;
        width: 100%;
    }
    #reportTable { width: 100% !important; }
    #reportTable thead { background: linear-gradient(90deg, #6366f1, #8b5cf6) !important; color: white; }
    #reportTable th { font-weight: 600; text-transform: uppercase; padding: 0.6rem; font-size: 0.75rem; vertical-align: middle; }
    #reportTable td { padding: 0.5rem; font-size: 0.8rem; color: #1e293b; border: 1px solid #e2e8f0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px; }
    #reportTable td:hover { white-space: normal; overflow: visible; background-color: #f5f3ff; position: relative; z-index: 10; cursor: help; }
    #reportTable tbody tr:hover { background-color: #f5f3ff !important; }
    
    .btn-3d { position: relative; padding: 0.4rem 0.8rem; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; border-radius: 0.5rem; transition: all 0.2s ease; top: 0; color: #fff !important; display: inline-flex; align-items: center; justify-content: center; border: none; }
    .btn-3d.btn-primary { background-color: #4f46e5; box-shadow: 0 3px 0 #3730a3; }
    .btn-3d.btn-primary:hover { background-color: #4338ca; transform: translateY(-2px); box-shadow: 0 5px 0 #3730a3; }
    .btn-3d.btn-success { background-color: #10b981; box-shadow: 0 3px 0 #047857; }
    .btn-3d.btn-success:hover { background-color: #059669; transform: translateY(-2px); box-shadow: 0 5px 0 #047857; }
    .btn-3d.btn-secondary { background-color: #6b7280; box-shadow: 0 3px 0 #374151; }
    .btn-3d.btn-secondary:hover { background-color: #4b5563; transform: translateY(-2px); box-shadow: 0 5px 0 #374151; }
    .btn-3d:active { top: 2px; transform: translateY(0); box-shadow: none !important; }
    </style>

    <div class="main-container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b border-gray-200 pb-3">
            <i class="bi bi-file-earmark-bar-graph text-indigo-600 mr-3"></i> Laporan Monitoring
            <span class="text-xl font-normal text-indigo-500">(Master Report)</span>
        </h1>

        <!-- Export Controls -->
        <div class="card mb-4 border-0 shadow-sm bg-light">
            <div class="card-body p-3">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <input type="text" id="searchExport" placeholder="Filter data..." value="<?= $this->input->get('search') ?>" class="form-control form-control-sm shadow-none border-gray-300" style="width: 250px;">
                    </div>
                    <div class="col-auto d-flex gap-2">
                        <form method="GET" action="<?= base_url('User/export_report_bast1') ?>" id="formBast1">
                            <input type="hidden" name="search" id="searchBast1" value="<?= $this->input->get('search') ?>">
                            <button type="submit" class="btn btn-primary btn-3d">
                                <i class="bi bi-file-earmark-excel me-1"></i> BAST 1
                            </button>
                        </form>
                        <form method="GET" action="<?= base_url('User/export_report_bast2') ?>" id="formBast2">
                            <input type="hidden" name="search" id="searchBast2" value="<?= $this->input->get('search') ?>">
                            <button type="submit" class="btn btn-success btn-3d">
                                <i class="bi bi-file-earmark-excel me-1"></i> BAST 2
                            </button>
                        </form>
                        <form method="GET" action="<?= base_url('User/export_report') ?>" id="formAll">
                            <input type="hidden" name="search" id="searchAll" value="<?= $this->input->get('search') ?>">
                            <button type="submit" class="btn btn-secondary btn-3d">
                                <i class="bi bi-grid me-1"></i> All Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive shadow-sm rounded-lg">
            <table id="reportTable" class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>No Kontrak</th>
                        <th>Nama PT</th>
                        <th>Pekerjaan</th>
                        <th>Asbuilt</th>
                        <th>BAST 1</th>
                        <th>Retensi</th>
                        <th>FA</th>
                        <th>BAST 2</th>
                        <th>Kirim POM</th>
                        <th>Kembali POM</th>
                        <th>Pusat</th>
                        <th>Kontraktor</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporan as $row) : ?>
                    <tr>
                        <td class="fw-bold text-dark"><?= $row['no_kontrak']; ?></td>
                        <td><?= $row['nama_pt']; ?></td>
                        <td title="<?= htmlspecialchars($row['pekerjaan']); ?>"><?= $row['pekerjaan']; ?></td>
                        <td><?= ($row['tgl_terima_asbuilt'] == '0000-00-00') ? '-' : $row['tgl_terima_asbuilt']; ?></td>
                        <td><?= ($row['tgl_terima_bast'] == '0000-00-00') ? '-' : $row['tgl_terima_bast']; ?></td>
                        <td><span class="badge bg-light text-dark border"><?= $row['opsi_retensi']; ?> Hari</span></td>
                        <td><?= ($row['tgl_closing'] == '0000-00-00') ? '-' : $row['tgl_closing']; ?></td>
                        <td><?= ($row['tgl_terima_bast2'] == '0000-00-00') ? '-' : $row['tgl_terima_bast2']; ?></td>
                        <td><?= ($row['tgl_pom'] == '0000-00-00') ? '-' : $row['tgl_pom']; ?></td>
                        <td><?= ($row['kembali_pom'] == '0000-00-00') ? '-' : $row['kembali_pom']; ?></td>
                        <td><?= ($row['tgl_pusat2'] == '0000-00-00') ? '-' : $row['tgl_pusat2']; ?></td>
                        <td><?= ($row['tgl_kontraktor2'] == '0000-00-00') ? '-' : $row['tgl_kontraktor2']; ?></td>
                        <td title="<?= htmlspecialchars($row['keterangan']); ?>"><?= $row['keterangan']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#reportTable').DataTable({
            "order": [],
            "pageLength": 25,
            "language": {
                "search": "Filter Table:",
                "paginate": {
                    "next": "<i class='bi bi-chevron-right'></i>",
                    "previous": "<i class='bi bi-chevron-left'></i>"
                }
            }
        });

        $('#searchExport').on('input', function() {
            const val = $(this).val();
            $('#searchBast1, #searchBast2, #searchAll').val(val);
        });
    });
    </script>
</main>
