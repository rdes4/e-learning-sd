
<?= $this->extend('v_siswa/layout/default'); ?>


<?= $this->section('title'); ?>

Detail Tugas

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('detailsiswa/showDetailMateriForSiswa/'.$materi->id_materi)?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

<div class="row">

    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0 text-primary font-weight-bold">Tugas</h6>
            </div>
            <div class="card-body">
            <form action="<?=base_url('detailsiswa/submitTugasSiswa/')?>" method="post" enctype="multipart/form-data">
                    
                    <?=csrf_field()?>
                    
                    <input type="hidden" name="id_detail_kelas" value="<?= $detailKelas->id_detail_kelas?>">
                    <input type="hidden" name="id_materi" value="<?=$materi->id_materi?>">
                    <input type="hidden" name="id_tugas" value="<?= $tugas->id_tugas ?>">
                    
                    <div class="form-group">
                        <label for="mata_pelajaran">Mata Pelajaran</label>
                        <input type="text" class="form-control" name="mata_pelajaran" id="mata_pelajaran" value="<?= $detailKelas->mata_pelajaran ?>" readonly> 
                        
                    </div>

                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <input type="text" class="form-control" name="Kelas" id="Kelas" value="<?= $detailKelas->kelas ?>" readonly> 
                        
                    </div>

                    <div class="form-group">
                        <label for="materi">Materi</label>
                        <input type="text" class="form-control" name="materi" id="materi" value="<?= $materi->judul_materi ?>" readonly> 
                        
                    </div>

                    <div class="form-group">
                        <label for="judul_tugas">Judul Tugas</label>

                        <input type="text" class="form-control <?=($validation->hasError('judul_tugas')) ? 'is-invalid' : '';?>" name="judul_tugas" id="judul_tugas" readonly value="<?= $tugas->judul_tugas ?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('judul_tugas')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="isi_tugas">Isi Tugas</label>
                        <textarea class="form-control" name="isi_tugas" id="isi_tugas" rows="3" readonly><?= $tugas->isi_tugas ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="isi_tugas">Kolom Jawaban Siswa</label>
                        <textarea class="form-control" name="isi_tugas" <?=($validation->hasError('isi_tugas')) ? 'is-invalid' : '';?>" id="jawaban_siswa" rows="3"></textarea>
                        <div class="invalid-feedback">
                            <?=$validation->getError('isi_tugas')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="file_tugas_siswa">Foto Tugas (Jika Ada)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept="image/*" name="file_tugas_siswa">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>

                    <input type="hidden" name="file_uploads_lama" value="<?= $tugas->file_tugas ?>">

                    <div class="form-group">
                        <label for="tanggal_kumpul">Batas Kumpul Tugas</label>
                        <input class="form-control" type="date" name="tanggal_kumpul" id="tanggal_kumpul" readonly value="<?= $tugas->tanggal_kumpul ?>">
                    </div>
              
                    <button type="submit" class="btn btn-primary" name="add"><i class="fas fa-plus-circle"></i> Kumpul Tugas</button>
                
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4 ">
            <div class="card-header">
                <h6 class="mb-0 text-primary font-weight-bold">File Tugas</h6>
            </div>
            <div class="card-body">
                <?php 
                    $path = $tugas->file_tugas;
                    $extension = pathinfo($path, PATHINFO_EXTENSION);
                ?>

                <?php if ($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg') : ?>
                    <a href="<?=base_url()?>/file_uploads/file_tugas/<?=$tugas->file_tugas?>" target="_blank">
                        <img src="<?=base_url()?>/file_uploads/file_tugas/<?=$tugas->file_tugas?>" alt=""  class="img-fluid">
                    </a>
                    <div class="mx-auto" style="width: 50%;">
                        <h6 class="mt-3"><i class="fas fa-search"></i> Klik gambar untuk melihat lebih jelas</h6>
                    </div>
                    
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>



<?= $this->endSection(); ?>