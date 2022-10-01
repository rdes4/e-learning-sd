
<?= $this->extend('v_siswa/layout/default'); ?>


<?= $this->section('title'); ?>

Detail Materi

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="row">

    <div class="col-lg-12">
    <a href="<?=base_url('detailsiswa/showMateriForSiswa/'.$materi->id_detail_kelas)?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

        <div class="card mb-2">
            <div class="card-header align-items-center">
                <div class="d-flex">
                    <div class="bd-highlight">
                        <h6 class="font-weight-bold text-primary"><?= $materi->judul_materi ?></h6>
                    </div>
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
                <a href="<?= base_url('detailsiswa/downloadFileMateriForSiswa/'.$materi->id_materi) ?>" class="btn btn-google btn-block"><i class="fas fa-cloud-download-alt"></i> Download File Materi</a>
                <?php endif ?>

                
            </div>
        </div>

        <!-- List Tugas -->
        <div class="card">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Tugas</h6>
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
                                                                    
                                    <div class="h6 font-weight-bold text-gray-800">
                                        Batas Kumpul : <?= $tanggal_kumpul; ?>
                                    </div>

                                    <?php $result = getTugasSiswaByIdSiswa(session()->get('id_siswa'), $data['id_tugas'])?>

                                    <?php if($tanggal_kumpul >= date('d-m-Y') && $result != ''):?>
                                    <div class="mb-2  badge badge-success text-wrap">
                                        Sudah mengumpulkan tugas pada tanggal <?= date("d-m-Y", strtotime($result->tanggal_kumpul_siswa)); ?>
                                    </div>

                                    <div>                                
                                    <?php if($data['file_tugas'] != '') :?>

                                        <a href="<?= base_url('detailsiswa/downloadFileTugasForSiswa/'.$data['id_tugas']) ?>" class="btn btn-google">
                                            <i class="fas fa-cloud-download-alt"></i> Download File Tugas
                                        </a>
                                    <?php endif ?>
                                 </div>

                                        
                                
                                </div>
                                
                                <div class="col-auto"> 
                                    <a href="<?= base_url('detailsiswa/showDetailTugasForSiswa/'.$data['id_tugas']).'/'.$materi->id_detail_kelas.'/'.$materi->id_materi ?>" class="btn btn-success mr-2">
                                        <i class="fas fa-search"></i> Detail
                                    </a>
                                </div>

                                    <?php elseif($tanggal_kumpul <= date('d-m-Y') && $result != ''):?>
                                    <div class="mb-2  badge badge-success text-wrap">
                                        Sudah mengumpulkan tugas pada tanggal <?= date("d-m-Y", strtotime($result->tanggal_kumpul_siswa)); ?>
                                    </div>

                                    <div class="mb-2">                                
                                    <?php if($data['file_tugas'] != '') :?>

                                        <a href="<?= base_url('detailsiswa/downloadFileTugasForSiswa/'.$data['id_tugas']) ?>" class="btn btn-google">
                                            <i class="fas fa-cloud-download-alt"></i> Download File Tugas
                                        </a>
                                    <?php endif ?>
                                 </div>

                                 
                                <div class="mb-2 badge badge-success text-wrap" style="font-size: 15px;">
                                    Nilai Tugas : <?= $result->nilai_tugas_siswa ?>
                                </div>
                                
                                </div>
                                
                                <div class="col-auto"> 
                                    <a href="<?= base_url('detailsiswa/showDetailTugasForSiswa/'.$data['id_tugas']).'/'.$materi->id_detail_kelas.'/'.$materi->id_materi ?>" class="btn btn-success mr-2">
                                        <i class="fas fa-search"></i> Detail
                                    </a>
                                </div>

                                    <?php elseif($tanggal_kumpul >= date('d-m-Y') && $result == ''):?>
                                    <div class="mb-2  badge badge-warning text-wrap text-dark">
                                        Belum mengumpulkan tugas, SEGERA KUMPULKAN !!
                                    </div>

                                    <div>                                
                                    <?php if($data['file_tugas'] != '') :?>

                                        <a href="<?= base_url('detailsiswa/downloadFileTugasForSiswa/'.$data['id_tugas']) ?>" class="btn btn-google">
                                            <i class="fas fa-cloud-download-alt"></i> Download File Tugas
                                        </a>
                                    <?php endif ?>
                                 </div>
                                
                                </div>
                                
                                <div class="col-auto"> 
                                    <a href="<?= base_url('detailsiswa/showDetailTugasForSiswa/'.$data['id_tugas']).'/'.$materi->id_detail_kelas.'/'.$materi->id_materi ?>" class="btn btn-success mr-2">
                                        <i class="fas fa-search"></i> Detail
                                    </a>
                                </div>

                                    <?php elseif($tanggal_kumpul < date('d-m-Y') && $result == '') : ?>
                                    <div class="mb-2 badge badge-danger text-wrap">
                                        Sudah melewati batas kumpul tugas
                                    </div>

                                    <div>                                
                                    <?php if($data['file_tugas'] != '') :?>

                                        <a href="<?= base_url('detailsiswa/downloadFileTugasForSiswa/'.$data['id_tugas']) ?>" class="btn btn-google">
                                            <i class="fas fa-cloud-download-alt"></i> Download File Tugas
                                        </a>
                                    <?php endif ?>
                                 </div>
                                
                                </div>
                                
                                <div class="col-auto"> 
                                    <a href="<?= base_url('detailsiswa/showDetailTugasForSiswa/'.$data['id_tugas']).'/'.$materi->id_detail_kelas.'/'.$materi->id_materi ?>" class="btn btn-secondary mr-2" style="pointer-events: none">
                                        <i class="fas fa-search"></i> Detail
                                    </a>
                                </div>

                                    <?php endif ?>


                            </div>
                        </li>
                    <?php endforeach ;?>
                </ul>
            <?php endif ?>

        </div>

        <!-- List Kuis -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Kuis</h6>
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

                                    <?php 
                                        $nilai_siswa = getNilaiKuisSiswa(session()->get('id_siswa'), $data['id_kuis']);   
                                    ?>
                                    
                                    <?php if($nilai_siswa != ''):?>
                                        <div class="mb-2  badge badge-primary text-wrap" style="font-size: 15px;">
                                            Nilai Kuis : <?= $nilai_siswa->nilai?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="col-auto">
                                    <a href="<?= base_url('detailsiswa/showDetailKuisForSiswa/'.$data['id_kuis']).'/'.$materi->id_detail_kelas.'/'.$materi->id_materi ?>" class="btn btn-success mr-2">
                                        <i class="fas fa-search"></i> Lihat Kuis
                                    </a>
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