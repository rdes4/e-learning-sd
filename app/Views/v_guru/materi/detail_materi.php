
<?= $this->extend('v_guru/layout/default'); ?>


<?= $this->section('title'); ?>

Detail Materi

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

    <?php if(session()->get('message')): ?> 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=session()->getFlashdata('message')?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

<div class="row">    
    <div class="col-lg-12">
    <a href="<?=base_url('detailguru/beriMateriByIdDetailKelas/'.$materi->id_detail_kelas)?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>
        <div class="card mb-2">
            <div class="card-header align-items-center">
                <div class="d-flex">
                    <div class="bd-highlight"><h6 class="font-weight-bold text-primary"><?= $materi->judul_materi ?></h6></div>
                    <div class="ml-auto bd-highlight"><a href="<?= base_url('detailguru/editMateri/'.$materi->id_materi.'/'.$materi->id_detail_kelas) ?>" class="btn btn-success"><i class="fas fa-edit"></i> Ubah Materi</a></div>
                </div>             
            </div>
            <div class="card-body">
                <div class="embed-responsive embed-responsive-16by9 mb-3">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $materi->link_video?>" allowfullscreen></iframe>
                </div>

                <hr>

                <div class="form-group">
                    <label class="font-weight-bold" for="isi_materi">Isi Materi</label>
                    <textarea readonly class="form-control" id="isi_materi" rows="3" style="font-size: 14pt"><?= $materi->isi_materi; ?></textarea>
                </div>

                <?php if($materi->file_uploads != '') : ?> 
                <hr>
                <a href="<?= base_url('detailguru/downloadFile/'.$materi->id_materi) ?>" class="btn btn-google btn-block"><i class="fas fa-cloud-download-alt"></i> Download File Materi</a>
                <?php endif ?>

                
            </div>
        </div>

        <!-- List Tugas -->
        <div class="card mb-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Tugas</h6>
            </div>
            <div class="card-body">
                
                <a href="<?= base_url('detailguru/createTugas/'.$materi->id_detail_kelas.'/'.$materi->id_materi) ?>" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah Tugas</a>
            </div>
            <?php if($tugas != '') :?>
                <ul class="list-group list-group-flush">
                    <?php foreach($tugas as $data) : ?>
                        <li class="list-group-item">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                        <?= $data['judul_tugas']; ?>
                                    </div>

                                    <?php $tanggal_kumpul = date("d-m-Y", strtotime($data['tanggal_kumpul'])); ?>
                                    <div class="h6 mb-2 font-weight-bold text-gray-800">Tanggal Kumpul : <?= $tanggal_kumpul; ?></div>
                                    <div>
                                    <?php if($data['file_tugas'] != '') :?>

                                        <a href="<?= base_url('detailguru/downloadFileTugas/'.$data['id_tugas']) ?>" class="btn btn-google">
                                            <i class="fas fa-cloud-download-alt"></i> File Tugas
                                        </a>
                                    <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    
                                    <a href="<?= base_url('detailguru/showDetailTugas/'.$data['id_tugas']).'/'.$materi->id_detail_kelas.'/'.$materi->id_materi ?>" class="btn btn-success mr-2">
                                        <i class="fas fa-search"></i> Detail
                                    </a>

                                    <a href="<?= base_url('detailguru/deleteTugas/'.$data['id_tugas'].'/'.$materi->id_materi) ?>" onclick="return confirm('Yakin ingin menghapus tugas?');" class="btn btn-warning"><i class="fas fa-trash-alt"></i> Hapus</a>

                                    
                                </div>
                            </div>
                        </li>
                    <?php endforeach ;?>
                </ul>
            <?php endif ?>

        </div>

        <!-- List Kuis -->
        <div class="card">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Kuis</h6>
            </div>
            <div class="card-body">
                
                <a href="<?= base_url('detailguru/createKuis/'.$materi->id_detail_kelas.'/'.$materi->id_materi) ?>" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah Kuis</a>
            </div>
            <?php if($kuis != '') :?>
                <ul class="list-group list-group-flush">
                    <?php foreach($kuis as $data) : ?>
                        <li class="list-group-item">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                        <?= $data['judul']; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    
                                    <a href="<?= base_url('detailguru/showDetailKuis/'.$data['id_kuis']).'/'.$materi->id_detail_kelas.'/'.$materi->id_materi ?>" class="btn btn-success mr-2">
                                        <i class="fas fa-search"></i> Detail
                                    </a>

                                    <a href="<?= base_url('detailguru/deletekuis/'.$data['id_kuis'].'/'.$materi->id_materi) ?>" onclick="return confirm('Yakin ingin menghapus tugas?');" class="btn btn-warning"><i class="fas fa-trash-alt"></i> Hapus</a>

                                    
                                </div>
                            </div>
                        </li>
                    <?php endforeach ;?>
                </ul>
            <?php endif ?>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>