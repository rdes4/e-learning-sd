<?= $this->extend('v_siswa/layout/default'); ?>


<?= $this->section('title'); ?>

Mata Pelajaran

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>


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
    <a href="<?=base_url('detailsiswa/list_mapel_siswa')?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

        <div class="card mb-4">
            <div class="card-header py-3">

            <table>
                <tbody>
                    <tr>
                        <td><h6 class="font-weight-bold text-primary">Mata Pelajaran</h6></td>
                        <td class="px-2 "><h6 class="font-weight-bold text-primary">:</h6></td>
                        <td>
                            <h6 class="font-weight-bold text-primary"><?= $detailKelas->mata_pelajaran.' - '.$detailKelas->kelas?></h6>
                        </td>
                    </tr>
                    <tr>
                    <td><h6 class="font-weight-bold text-primary">Guru</h6></td>
                        <td class="px-2 "><h6 class="font-weight-bold text-primary">:</h6></td>
                        <td>
                        <h6 class="font-weight-bold text-primary"><?=$detailKelas->nama_guru?></h6>
                        </td>
                    </tr>
                </tbody>
            </table>
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

                <a href="<?=base_url('detailsiswa/showDetailMateriForSiswa/'.$data['id_materi'])?>" class="btn btn-primary btn-icon-split">
                    <span class="text">Detail</span>
                    <span class="icon text-white-50">
                    <i class="fas fa-search"></i>
                    </span>
                </a>
            </div>
        </div>

    </div>
    <?php endforeach; ?>

    <?php endif ?>
    
</div>

<?= $this->endSection(); ?>