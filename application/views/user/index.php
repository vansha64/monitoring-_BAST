<main id="main" class="main">

    <div class="pagetitle">
        <h1>My Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-lg-6">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-4 text-center">
                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-fluid rounded-circle p-2" style="max-width: 150px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $user['name']; ?></h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8"><?= $user['email']; ?></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-3 col-md-4 label">Member Since</div>
                                        <div class="col-lg-9 col-md-8"><?= date('d F Y', $user['date_created']); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->