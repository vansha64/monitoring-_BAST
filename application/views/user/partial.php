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
    #partial-data-tabel { width: 100% !important; }
    #partial-data-tabel thead { background: linear-gradient(90deg, #3b82f6, #06b6d4) !important; color: white; }
    #partial-data-tabel th { font-weight: 600; text-transform: uppercase; padding: 0.6rem; font-size: 0.8rem; }
    #partial-data-tabel td { padding: 0.55rem; font-size: 0.85rem; color: #1e293b; border: 1px solid #e2e8f0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    #partial-data-tabel td:hover { white-space: normal; overflow: visible; background-color: #e0f2fe; position: relative; z-index: 10; }
    #partial-data-tabel tbody tr:hover { background-color: #f0f9ff !important; }
    
    .btn-3d { position: relative; padding: 0.4rem 0.8rem; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; border-radius: 0.5rem; transition: all 0.2s ease; top: 0; color: #fff !important; display: inline-flex; align-items: center; justify-content: center; line-height: 1; border: none; }
    .btn-3d.btn-teal { background-color: #14b8a6; box-shadow: 0 3px 0 #0f766e; }
    .btn-3d.btn-teal:hover { background-color: #0d9488; transform: translateY(-2px); box-shadow: 0 5px 0 #0f766e; }
    .btn-3d.btn-indigo { background-color: #4f46e5; box-shadow: 0 3px 0 #3730a3; }
    .btn-3d.btn-indigo:hover { background-color: #4338ca; transform: translateY(-2px); box-shadow: 0 5px 0 #3730a3; }
    .btn-3d:active { top: 2px; transform: translateY(0); box-shadow: none !important; }
    </style>

    <div class="main-container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b border-gray-200 pb-3">
            <i class="bi bi-tools text-indigo-600 mr-3"></i> Berita Acara Partial
            <span class="text-xl font-normal text-indigo-500">(Pemasangan)</span>
        </h1>

        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('message')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('message'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="d-flex gap-2 mb-4">
            <a href="<?= base_url('user/export_partial'); ?>" class="btn btn-success btn-3d">
                <i class="bi bi-file-earmark-excel me-1"></i> Export Data
            </a>
            <button class="btn btn-primary btn-3d" data-bs-toggle="modal" data-bs-target="#newPartialModal">
                <i class="bi bi-plus-lg me-1"></i> Add New Partial
            </button>
        </div>

        <div class="table-responsive shadow-sm rounded-lg overflow-hidden">
            <table class="table table-hover align-middle mb-0" id="partial-data-tabel">
                <thead>
                    <tr>
                        <th>Lokasi</th>
                        <th>Area</th>
                        <th>Pekerjaan</th>
                        <th>Kontraktor</th>
                        <th>No Dokumen</th>
                        <th>Kirim POM</th>
                        <th>Kembali POM</th>
                        <th>Kembali Kontraktor</th>
                        <th>Keterangan</th>
                        <th>Scan PDF</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($partials as $partial) : ?>
                        <tr>
                            <td><?= $partial['lokasi']; ?></td>
                            <td><?= $partial['area']; ?></td>
                            <td><?= $partial['pekerjaan']; ?></td>
                            <td><?= $partial['nama_kontraktor']; ?></td>
                            <td><?= $partial['no_dokumen']; ?></td>
                            <td><?= $partial['tgl_kirim_pom']; ?></td>
                            <td><?= $partial['tgl_kembali_pom']; ?></td>
                            <td><?= $partial['tgl_kembali_kontraktor']; ?></td>
                            <td><?= $partial['keterangan']; ?></td>
                            <td>
                                <?php if ($partial['scan_pdf']) : ?>
                                    <a href="<?= base_url('assets/upload/partial/' . $partial['scan_pdf']); ?>" target="_blank" class="badge bg-info text-dark text-decoration-none">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> View PDF
                                    </a>
                                <?php else : ?>
                                    <span class="badge bg-secondary">No File</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#detailModal" 
                                        data-lokasi="<?= $partial['lokasi']; ?>" data-area="<?= $partial['area']; ?>" 
                                        data-pekerjaan="<?= $partial['pekerjaan']; ?>" data-nama_kontraktor="<?= $partial['nama_kontraktor']; ?>" 
                                        data-no_dokumen="<?= $partial['no_dokumen']; ?>" data-tgl_kirim_pom="<?= $partial['tgl_kirim_pom']; ?>" 
                                        data-tgl_kembali_pom="<?= $partial['tgl_kembali_pom']; ?>" data-tgl_kembali_kontraktor="<?= $partial['tgl_kembali_kontraktor']; ?>" 
                                        data-keterangan="<?= $partial['keterangan']; ?>" data-scan_pdf="<?= $partial['scan_pdf']; ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" 
                                        data-id_parsial="<?= $partial['id_parsial']; ?>" data-lokasi="<?= $partial['lokasi']; ?>" 
                                        data-area="<?= $partial['area']; ?>" data-pekerjaan="<?= $partial['pekerjaan']; ?>" 
                                        data-nama_kontraktor="<?= $partial['nama_kontraktor']; ?>" data-no_dokumen="<?= $partial['no_dokumen']; ?>" 
                                        data-tgl_kirim_pom="<?= $partial['tgl_kirim_pom']; ?>" data-tgl_kembali_pom="<?= $partial['tgl_kembali_pom']; ?>" 
                                        data-tgl_kembali_kontraktor="<?= $partial['tgl_kembali_kontraktor']; ?>" data-keterangan="<?= $partial['keterangan']; ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modals -->
    <!-- New Partial Modal -->
    <div class="modal fade" id="newPartialModal" tabindex="-1" aria-labelledby="newPartialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="newPartialModalLabel">Add New Partial Data</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('user/add'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Area</label>
                            <input type="text" class="form-control" name="area" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Pekerjaan</label>
                            <textarea class="form-control" name="pekerjaan" rows="2" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Kontraktor</label>
                            <input type="text" class="form-control" name="nama_kontraktor" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No Dokumen</label>
                            <input type="text" class="form-control" name="no_dokumen" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tgl Kirim POM</label>
                            <input type="date" class="form-control" name="tgl_kirim_pom">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tgl Kembali POM</label>
                            <input type="date" class="form-control" name="tgl_kembali_pom">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tgl Kembali Kontraktor</label>
                            <input type="date" class="form-control" name="tgl_kembali_kontraktor">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Scan PDF</label>
                            <input type="file" class="form-control" name="scan_pdf">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel">Edit Partial Data</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('user/update_partial'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body row g-3">
                        <input type="hidden" id="edit-id" name="id_parsial">
                        <div class="col-md-6">
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="edit-lokasi" name="lokasi" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Area</label>
                            <input type="text" class="form-control" id="edit-area" name="area" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Pekerjaan</label>
                            <textarea class="form-control" id="edit-pekerjaan" name="pekerjaan" rows="2" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Kontraktor</label>
                            <input type="text" class="form-control" id="edit-nama_kontraktor" name="nama_kontraktor" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No Dokumen</label>
                            <input type="text" class="form-control" id="edit-no_dokumen" name="no_dokumen" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tgl Kirim POM</label>
                            <input type="date" class="form-control" id="edit-tgl_kirim_pom" name="tgl_kirim_pom">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tgl Kembali POM</label>
                            <input type="date" class="form-control" id="edit-tgl_kembali_pom" name="tgl_kembali_pom">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tgl Kembali Kontraktor</label>
                            <input type="date" class="form-control" id="edit-tgl_kembali_kontraktor" name="tgl_kembali_kontraktor">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="edit-keterangan" name="keterangan">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Scan PDF (Optional)</label>
                            <input type="file" class="form-control" name="scan_pdf">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Partial Data</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm">
                        <tr><th width="40%">Lokasi</th><td id="detail-lokasi"></td></tr>
                        <tr><th>Area</th><td id="detail-area"></td></tr>
                        <tr><th>Pekerjaan</th><td id="detail-pekerjaan"></td></tr>
                        <tr><th>Kontraktor</th><td id="detail-nama_kontraktor"></td></tr>
                        <tr><th>No Dokumen</th><td id="detail-no_dokumen"></td></tr>
                        <tr><th>Tgl Kirim POM</th><td id="detail-tgl_kirim_pom"></td></tr>
                        <tr><th>Tgl Kembali POM</th><td id="detail-tgl_kembali_pom"></td></tr>
                        <tr><th>Tgl Kembali Kontraktor</th><td id="detail-tgl_kembali_kontraktor"></td></tr>
                        <tr><th>Keterangan</th><td id="detail-keterangan"></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#partial-data-tabel').DataTable({
                "stateSave": true
            });

            // Detail modal
            $('#detailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                $('#detail-lokasi').text(button.data('lokasi'));
                $('#detail-area').text(button.data('area'));
                $('#detail-pekerjaan').text(button.data('pekerjaan'));
                $('#detail-nama_kontraktor').text(button.data('nama_kontraktor'));
                $('#detail-no_dokumen').text(button.data('no_dokumen'));
                $('#detail-tgl_kirim_pom').text(button.data('tgl_kirim_pom'));
                $('#detail-tgl_kembali_pom').text(button.data('tgl_kembali_pom'));
                $('#detail-tgl_kembali_kontraktor').text(button.data('tgl_kembali_kontraktor'));
                $('#detail-keterangan').text(button.data('keterangan'));
            });

            // Edit modal
            $('.edit-btn').on('click', function() {
                var btn = $(this);
                $('#edit-id').val(btn.data('id_parsial'));
                $('#edit-lokasi').val(btn.data('lokasi'));
                $('#edit-area').val(btn.data('area'));
                $('#edit-pekerjaan').val(btn.data('pekerjaan'));
                $('#edit-nama_kontraktor').val(btn.data('nama_kontraktor'));
                $('#edit-no_dokumen').val(btn.data('no_dokumen'));
                $('#edit-tgl_kirim_pom').val(btn.data('tgl_kirim_pom'));
                $('#edit-tgl_kembali_pom').val(btn.data('tgl_kembali_pom'));
                $('#edit-tgl_kembali_kontraktor').val(btn.data('tgl_kembali_kontraktor'));
                $('#edit-keterangan').val(btn.data('keterangan'));
            });
        });
    </script>
</main>
