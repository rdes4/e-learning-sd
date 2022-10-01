
<?= $this->extend('layout/default'); ?>

<?= $this->section('title'); ?>

Home

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">My Profile</h1>

    <!-- My Profile Card -->
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
            <img src="<?= base_url('')?>/template/img/undraw_profile_2.svg">
            </div>
            <div class="col-md-8">
            <div class="card-body">

            <?php if (session()->get('logAdmin')) : ?>
                <h5 class="card-title">Nama User : <?= session()->get('nama_admin') ?></h5>
            <?php else : ?>
                <h5 class="card-title">Nama User : Guru</h5>
                <p class="card-text">NIP</p>
            <?php endif ?>        

            </div>
            </div>
        </div>
    </div>


<?= $this->endSection(); ?>

