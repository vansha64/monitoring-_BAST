<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manajemen Data BAST</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Partial BAST</li>
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
                        <h5 class="card-title">Data Partial BAST</h5>
                        
                        <div class="mb-3">
                            <a href="<?= base_url('user/export_partial'); ?>" class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i> Export Excel
                            </a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newPartialModal">
                                <i class="bi bi-plus-circle"></i> Add New Partial
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover datatable" id="partial-data-tabel">
                                <thead>
                                    <tr>
                                        <th>Lokasi</th>
                                        <th>Area</th>
                                        <th>Pekerjaan</th>
                                        <th>Nama Kontraktor</th>
                                        <th>No Dokumen</th>
                                        <th>Tgl Kirim POM</th>
                                        <th>Tgl Kembali POM</th>
                                        <th>Action</th>
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
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $partial['id_parsial']; ?>">
                                                    <i class="bi bi-info-circle"></i>
                                                </button>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $partial['id_parsial']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Detail Modal -->
                                        <div class="modal fade" id="detailModal<?= $partial['id_parsial']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Partial Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Lokasi:</strong> <?= $partial['lokasi']; ?></p>
                                                        <p><strong>Area:</strong> <?= $partial['area']; ?></p>
                                                        <p><strong>Pekerjaan:</strong> <?= $partial['pekerjaan']; ?></p>
                                                        <p><strong>Nama Kontraktor:</strong> <?= $partial['nama_kontraktor']; ?></p>
                                                        <p><strong>No Dokumen:</strong> <?= $partial['no_dokumen']; ?></p>
                                                        <p><strong>Tgl Kirim POM:</strong> <?= $partial['tgl_kirim_pom']; ?></p>
                                                        <p><strong>Tgl Kembali POM:</strong> <?= $partial['tgl_kembali_pom']; ?></p>
                                                        <p><strong>Keterangan:</strong> <?= $partial['keterangan']; ?></p>
                                                        <?php if ($partial['scan_pdf']) : ?>
                                                            <p><strong>Scan PDF:</strong> <a href="<?= base_url('assets/upload/partial/' . $partial['scan_pdf']); ?>" target="_blank">View File</a></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal<?= $partial['id_parsial']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Partial Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url('user/update_partial'); ?>" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_parsial" value="<?= $partial['id_parsial']; ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Lokasi</label>
                                                                <input type="text" class="form-control" name="lokasi" value="<?= $partial['lokasi']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Area</label>
                                                                <input type="text" class="form-control" name="area" value="<?= $partial['area']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Pekerjaan</label>
                                                                <input type="text" class="form-control" name="pekerjaan" value="<?= $partial['pekerjaan']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Kontraktor</label>
                                                                <input type="text" class="form-control" name="nama_kontraktor" value="<?= $partial['nama_kontraktor']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">No Dokumen</label>
                                                                <input type="text" class="form-control" name="no_dokumen" value="<?= $partial['no_dokumen']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Tgl Kirim POM</label>
                                                                <input type="date" class="form-control" name="tgl_kirim_pom" value="<?= $partial['tgl_kirim_pom']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Tgl Kembali POM</label>
                                                                <input type="date" class="form-control" name="tgl_kembali_pom" value="<?= $partial['tgl_kembali_pom']; ?>">
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

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- New Partial Modal -->
    <div class="modal fade" id="newPartialModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Partial Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('user/add'); ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Area</label>
                            <input type="text" class="form-control" name="area" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Kontraktor</label>
                            <input type="text" class="form-control" name="nama_kontraktor" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Dokumen</label>
                            <input type="text" class="form-control" name="no_dokumen" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tgl Kirim POM</label>
                            <input type="date" class="form-control" name="tgl_kirim_pom">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tgl Kembali POM</label>
                            <input type="date" class="form-control" name="tgl_kembali_pom">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>