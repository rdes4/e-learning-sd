
<?= $this->extend('layout/default'); ?>


<?= $this->section('title'); ?>

Tambah Data Mata Pelajaran

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('mapel')?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

<h1 class="h3 mb-4 text-gray-800">Tambah Data Mata Pelajaran</h1>


    <div class="row">
        <div class="col-md-8">

            <div class="card shadow mb-4">
                <div class="card-body">
                <form action="<?=base_url('mapel/save_mapel')?>" method="post">
                    
                    <?=csrf_field()?>
                    <div class="form-group">
                        <label for="mata_pelajaran">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control <?=($validation->hasError('mata_pelajaran')) ? 'is-invalid' : '';?>" name="mata_pelajaran" id="mata_pelajaran" value="<?=old('mata_pelajaran')?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('mata_pelajaran')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipe_mapel">Tipe Mata Pelajaran</label>
                        <select class="form-control" name="tipe_mapel">
                            <option value="1">Umum</option>
                            <option value="2">Khusus</option>
                        </select> 
                    </div>
              
                    <button type="submit" class="btn btn-primary btn-add-siswa" name="add">Tambah Data</button>
                
                </form>    
                </div>
            </div>
        </div>
    </div>


<?= $this->endSection(); ?>