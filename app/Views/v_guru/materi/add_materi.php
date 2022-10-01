
<?= $this->extend('v_guru/layout/default'); ?>


<?= $this->section('title'); ?>

Tambah Materi

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<a href="<?=base_url('detailguru/beriMateriByIdDetailKelas/'.$detailKelas->id_detail_kelas)?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>
<h1 class="h3 mb-4 text-gray-800">Tambah Materi</h1>

    <div class="row">
        <div class="col-md-8">

            <div class="card shadow mb-4">
                
                <div class="card-body">
                <form action="<?=base_url('detailguru/save_materi')?>" method="post" enctype="multipart/form-data">
                    
                    <?=csrf_field()?>
                    <input type="hidden" name="id_detail_kelas" value="<?=$detailKelas->id_detail_kelas?>">

                    <div class="form-group">
                        <label for="mata_pelajaran">Mata Pelajaran</label>
                        <input type="text" class="form-control <?=($validation->hasError('mata_pelajaran')) ? 'is-invalid' : '';?>" name="mata_pelajaran" id="mata_pelajaran" value="<?= $detailKelas->mata_pelajaran ?>" readonly> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('mata_pelajaran')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <input type="text" class="form-control <?=($validation->hasError('Kelas')) ? 'is-invalid' : '';?>" name="Kelas" id="Kelas" value="<?= $detailKelas->kelas ?>" readonly> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('Kelas')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="judul_materi">Judul Materi</label>

                        <input type="text" class="form-control <?=($validation->hasError('judul_materi')) ? 'is-invalid' : '';?>" name="judul_materi" id="judul_materi" value="<?=old('judul_materi')?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('judul_materi')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="isi_materi">Isi Materi</label>
                        <textarea class="form-control" name="isi_materi" id="isi_materi" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="link_video">Link Video Pembelajaran (Jika Ada)</label>
                        <small id="link_video" class="form-text text-muted">
                            <ul>
                                <li>Silahkan salin alamat URL dari Youtube</li>
                                <li>Ambil kode dari link tersebut</li>
                                <li>Contoh : https://www.youtube.com/watch?v=MqNzj0f5_VQ</li>
                                <li class="font-weight-bold">Kodenya adalah : "MqNzj0f5_VQ"</li>
                            </ul>
                        </small>
                        <input type="text" class="form-control <?=($validation->hasError('link_video')) ? 'is-invalid' : '';?>" name="link_video" id="link_video" value="<?=old('link_video')?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('link_video')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="file_materi">File Materi Pembelajaran (Jika Ada)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file_materi">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>

              
                    <button type="submit" class="btn btn-primary btn-add-siswa" name="add"><i class="fas fa-plus-circle"></i> Buat Materi</button>
                
                </form>    
                </div>
            </div>
        </div>
    </div>


<?= $this->endSection(); ?>