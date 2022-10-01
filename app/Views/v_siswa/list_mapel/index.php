<?= $this->extend('v_siswa/layout/default'); ?>


<?= $this->section('title'); ?>

Daftar Mata Pelajaran

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="row">
    <?php foreach($mapel_siswa as $row) : ?>
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card">
                <img class="card-img-top" src="https://img.freepik.com/free-vector/floating-books-cartoon-vector-icon-illustration-object-education-icon-concept-isolated-premium-vector-flat-cartoon-style_138676-4013.jpg?w=740&t=st=1653265594~exp=1653266194~hmac=0f861f0e378cff3db22f5441f5e0aa12855359abd6a012b662fc4d5d4d67b84e">
                <div class="card-body">
                    <h4 class="card-title"><?= $row['mata_pelajaran'] ?></h4>
                    <div class="h6 font-weight-bold text-gray-800">Guru : <?= $row['nama_guru'] ?></div>
                    <div class="h6 font-weight-bold text-gray-800">Kelas : <?= $row['kelas'] ?></div>
                    <a href="<?=base_url('detailsiswa/showMateriForSiswa/'.$row['id_detail_kelas'])?>" class="btn btn-primary btn-icon-split">
                        <span class="text">Lihat</span>
                        <span class="icon text-white-50">
                        <i class="fas fa-search"></i>
                        </span>
                    </a>
                </div>
            </div>

        </div>
    <?php endforeach; ?>    
</div>
<?= $this->endSection(); ?>