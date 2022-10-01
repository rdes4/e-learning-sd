
<?= $this->extend('v_guru/layout/default'); ?>

<?= $this->section('title'); ?>

Tambah Kuis

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('detailguru/showDetailMateri/'.$materi->id_materi)?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

<h1 class="h3 mb-4 text-gray-800">Tambah Kuis</h1>


    <div class="row">
        <div class="col-md-8">

            <div class="card shadow mb-4">
                
                <div class="card-body">
                <form action="<?=base_url('detailguru/saveKuis')?>" method="post" enctype="multipart/form-data">
                    
                    <?=csrf_field()?>
                    <input type="hidden" name="id_detail_kelas" value="<?=$detailKelas->id_detail_kelas?>">
                    <input type="hidden" name="id_materi" value="<?=$materi->id_materi?>">
                    
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
                        <label for="judul_kuis">Judul Kuis</label>

                        <input type="text" class="form-control <?=($validation->hasError('judul_kuis')) ? 'is-invalid' : '';?>" name="judul_kuis" id="judul_kuis" value="<?=old('judul_kuis')?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('judul_kuis')?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-add-siswa" name="add"><i class="fas fa-plus-circle"></i> Buat Kuis</button>
                
                </form>    
                </div>
            </div>
        </div>
    </div>

    

<?= $this->endSection(); ?>