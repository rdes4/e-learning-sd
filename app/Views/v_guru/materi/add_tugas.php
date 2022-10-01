
<?= $this->extend('v_guru/layout/default'); ?>

<?= $this->section('title'); ?>

Tambah Tugas

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('detailguru/showDetailMateri/'.$materi->id_materi)?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

<h1 class="h3 mb-4 text-gray-800">Tambah Tugas</h1>

    <div class="row">
        <div class="col-md-8">

            <div class="card shadow mb-4">
                
                <div class="card-body">
                <form action="<?=base_url('detailguru/save_tugas')?>" method="post" enctype="multipart/form-data">
                    
                    <?=csrf_field()?>
                    <input type="hidden" name="id_detail_kelas" value="<?=$detailKelas->id_detail_kelas?>">
                    <input type="hidden" name="id_materi" value="<?=$materi->id_materi?>">
                    <input type="hidden" name="id_kelas" value="<?=$detailKelas->id_kelas?>">
                    
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

                        <input type="text" class="form-control <?=($validation->hasError('judul_tugas')) ? 'is-invalid' : '';?>" name="judul_tugas" id="judul_tugas" value="<?=old('judul_tugas')?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('judul_tugas')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="isi_tugas">Isi Tugas</label>
                        <textarea class="form-control" name="isi_tugas" id="isi_tugas" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="file_tugas">File atau Foto Tugas (Jika Ada)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file_tugas">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_kumpul">Batas Kumpul</label>
                        <input class="form-control" type="date" name="tanggal_kumpul" id="">
                    </div>
              
                    <button type="submit" class="btn btn-primary btn-add-siswa" name="add"><i class="fas fa-plus-circle"></i> Buat Tugas</button>
                
                </form>
                    
                </div>
            </div>
        </div>
    </div> 

<?= $this->endSection(); ?>