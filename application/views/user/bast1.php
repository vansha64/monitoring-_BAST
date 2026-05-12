<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data BAST 1</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                <li class="breadcrumb-item active">BAST 1</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

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

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List Data BAST 1 (Asbuilt Drawing)</h5>

                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBastModal">
                                <i class="bi bi-plus-circle"></i> Tambah Data
                            </button>
                            <a href="<?= site_url('user/export_bast') ?>" class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i> Export Excel
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover datatable" id="data-tabel">
                                <thead>
                                    <tr>
                                        <th>No Kontrak</th>
                                        <th>Nama PT</th>
                                        <th>Pekerjaan</th>
                                        <th>Tgl Terima BAST 1</th>
                                        <th>Status Revisi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bastData as $data) : ?>
                                        <tr>
                                            <td><?= $data['no_kontrak']; ?></td>
                                            <td><?= $data['nama_pt']; ?></td>
                                            <td><?= $data['pekerjaan']; ?></td>
                                            <td><?= $data['tgl_terima_bast']; ?></td>
                                            <td>
                                                <?php if (!empty($data['is_revisi']) && $data['is_revisi'] == 1) : ?>
                                                    <span class="badge bg-danger"><i class="bi bi-exclamation-circle"></i> Revisi</span>
                                                <?php else : ?>
                                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Normal</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal1" 
                                                    data-nokontrak="<?= $data['no_kontrak']; ?>"
                                                    data-namapt="<?= $data['nama_pt']; ?>" 
                                                    data-pekerjaan="<?= $data['pekerjaan']; ?>"
                                                    data-tanggalasbuilt="<?= $data['tanggal_terima_asbuilt']; ?>"
                                                    data-statusasbuilt="<?= $data['status_asbuilt']; ?>"
                                                    data-opsiretensi="<?= $data['opsi_retensi']; ?>"
                                                    data-tglbast="<?= $data['tgl_terima_bast']; ?>" 
                                                    data-tglpusat="<?= $data['tgl_pusat']; ?>"
                                                    data-tglkontraktor="<?= $data['tgl_kontraktor']; ?>"
                                                    data-keterangan="<?= $data['keterangan_bast']; ?>" 
                                                    data-filepdf="<?= $data['file_pdf']; ?>">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal1" 
                                                    data-id_bast="<?= $data['id_bast']; ?>"
                                                    data-nokontrak="<?= $data['no_kontrak']; ?>" 
                                                    data-namapt="<?= $data['nama_pt']; ?>"
                                                    data-pekerjaan="<?= $data['pekerjaan']; ?>"
                                                    data-tanggalasbuilt="<?= $data['tanggal_terima_asbuilt']; ?>"
                                                    data-id_asbuilt="<?= $data['id_asbuilt']; ?>"
                                                    data-statusasbuilt="<?= $data['status_asbuilt']; ?>"
                                                    data-opsiretensi="<?= $data['opsi_retensi']; ?>"
                                                    data-tglbast="<?= $data['tgl_terima_bast']; ?>" 
                                                    data-tglpusat="<?= $data['tgl_pusat']; ?>"
                                                    data-tglkontraktor="<?= $data['tgl_kontraktor']; ?>"
                                                    data-keterangan="<?= $data['keterangan_bast']; ?>" 
                                                    data-filepdf="<?= $data['file_pdf']; ?>"
                                                    data-isrevisi="<?= !empty($data['is_revisi']) ? $data['is_revisi'] : 0; ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal1" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data BAST 1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>No Kontrak:</strong> <span id="modalNoKontrak"></span></p>
                            <p><strong>Nama PT:</strong> <span id="modalNamaPT"></span></p>
                            <p><strong>Pekerjaan:</strong> <span id="modalPekerjaan"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tgl Terima BAST:</strong> <span id="modalTglBast"></span></p>
                            <p><strong>Status Asbuilt:</strong> <span id="modalStatusAsbuilt"></span></p>
                            <p><strong>Keterangan:</strong> <span id="modalKeterangan"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal1" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data BAST 1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm1" action="<?= base_url('user/updatebast1') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id_bast" id="editIdBast">
                        <input type="hidden" id="editIdAsbuilt" name="id_asbuilt">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">No Kontrak</label>
                                    <input type="text" id="editNoKontrak" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Terima BAST 1</label>
                                    <input type="date" id="editTglBast" name="tgl_terima_bast" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea id="editKeterangan" name="keterangan" class="form-control"></textarea>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="editIsRevisi" name="is_revisi" value="1" class="form-check-input">
                                    <label class="form-check-label" for="editIsRevisi">Revisi</label>
                                </div>
                            </div>
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

    <!-- Add Modal -->
    <div class="modal fade" id="addBastModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data BAST 1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('user/add_bast_data'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">No Kontrak</label>
                                    <select class="form-select" name="no_kontrak" id="add_no_kontrak" required>
                                        <option value="">Pilih No Kontrak</option>
                                        <?php foreach ($id_asbuilts as $asbuilt) : ?>
                                            <option value="<?= $asbuilt['no_kontrak']; ?>" data-id-asbuilt="<?= $asbuilt['id_asbuilt']; ?>">
                                                <?= $asbuilt['no_kontrak']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="id_asbuilt" id="add_id_asbuilt">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Terima BAST 1</label>
                                    <input type="date" name="tgl_terima_bast" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

<script>
$(document).ready(function() {
    $(document).on('click', '.btn-detail', function() {
        $('#modalNoKontrak').text($(this).data('nokontrak'));
        $('#modalNamaPT').text($(this).data('namapt'));
        $('#modalPekerjaan').text($(this).data('pekerjaan'));
        $('#modalTglBast').text($(this).data('tglbast'));
        $('#modalStatusAsbuilt').text($(this).data('statusasbuilt'));
        $('#modalKeterangan').text($(this).data('keterangan'));
    });

    $(document).on('click', '.edit-btn', function() {
        $('#editIdBast').val($(this).data('id_bast'));
        $('#editIdAsbuilt').val($(this).data('id_asbuilt'));
        $('#editNoKontrak').val($(this).data('nokontrak'));
        $('#editTglBast').val($(this).data('tglbast'));
        $('#editKeterangan').val($(this).data('keterangan'));
        $('#editIsRevisi').prop('checked', $(this).data('isrevisi') == 1);
    });

    $('#add_no_kontrak').change(function() {
        var idAsbuilt = $(this).find(':selected').data('id-asbuilt');
        $('#add_id_asbuilt').val(idAsbuilt);
    });
});
</script>