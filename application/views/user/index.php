<main id="main" class="main">
<div class="container-fluid" style="background-image: url('assets/img/background/logo1.jpg'); background-size: cover; background-position: center; height: 100vh;">



        <div class="row">
            <div class="col-lg-6">
                <?= $this->session->flashdata('message');  ?>
            </div>
        </div>

        <div class="card mb-3 col-lg-8">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title text-dark"><?= $user['name']; ?></h5>
                        <p class="card-text text-dark"><?= $user['email']; ?></p>
                        <p class="card-text text-dark"><small class="text-body-secondary">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                    </div>
                </div>
            </div>
        </div>
</div>
</main>
