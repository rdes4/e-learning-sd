<?= $this->extend('v_guru/layout/default'); ?>


<?= $this->section('title'); ?>

Mata Pelajaran

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<link href="<?=base_url()?>/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<div class="row">

        <!-- Flashdata -->
        <?php if(session()->get('message')): ?>
            <div class="col-lg-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?=session()->getFlashdata('message')?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            </div>

        <?php endif; ?>


    <div class="col-lg-12">
    <a href="<?=base_url('detailguru/list_mapel')?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>
    
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $detailKelas->mata_pelajaran.' - '.$detailKelas->kelas ?></h6>
            </div>
            <div class="card-body">
            <a href="<?=base_url('detailguru/create/'.$detailKelas->id_detail_kelas)?>" class="btn btn-google"><i class="fas fa-plus"></i> Tambah Materi</a>
            </div>
        </div>
    </div>

    <?php if($listMateri == NULL) :?>
        <div class="col-lg-12 mb-4">
            <h3>DATA KOSONG</h3>
        </div>
    <?php else :?>

    <?php foreach($listMateri as $data) : ?>
        <div class="col-md-4 col-lg-3">
        <div class="card">
            <iframe src="https://www.youtube.com/embed/<?= $data['link_video']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="card-body">
                <h4 class="card-title"><?= $data['judul_materi']; ?></h4>

                <a href="<?=base_url('detailguru/showDetailMateri/'.$data['id_materi'])?>" class="btn btn-primary btn-icon-split">
                    <span class="text">Detail</span>
                    <span class="icon text-white-50">
                    <i class="fas fa-search"></i>
                    </span>
                </a>

                <a href="<?=base_url('detailguru/deleteMateri/'.$data['id_materi'].'/'. $detailKelas->id_detail_kelas)?>" onclick="return confirm('Yakin ingin menghapus materi?');" class="btn btn-danger ml-auto">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </div>

    </div>
    <?php endforeach; ?>

    <?php endif ?>
    
</div>

<?= $this->endSection(); ?>