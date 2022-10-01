
<?= $this->extend('layout/default'); ?>


<?= $this->section('title'); ?>

Ubah Data Mata Pelajaran

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('mapel')?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

<h1 class="h3 mb-4 text-gray-800">Ubah Data Mata Pelajaran</h1>


    <div class="row">
        <div class="col-md-8">

            <div class="card shadow mb-4">
                <div class="card-body">
                <form action="<?=base_url('mapel/updatemapel/'.$mapel->id_mapel)?>" method="post">
                    
                    <?=csrf_field()?>
                    <div class="form-group">
                        <label for="mata_pelajaran">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control <?=($validation->hasError('mata_pelajaran')) ? 'is-invalid' : '';?>" name="mata_pelajaran" id="mata_pelajaran" value="<?= $mapel->mata_pelajaran ?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('mata_pelajaran')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipe_mapel">Tipe Mapel</label>
                        <select class="form-control" name="tipe_mapel">
                                <?php if ($mapel->tipe_mapel == "1") : ?>
                                    <option selected value="1">Umum</option>
                                    <option value="2">Khusus</option>
                                <?php elseif($mapel->tipe_mapel == "2") : ?>
                                    <option selected value="2">Khusus</option>
                                    <option value="1">Umum</option>
                                <?php endif; ?>
                        </select> 
                    </div>
              
                    <button type="submit" class="btn btn-primary btn-add-siswa" name="add">Ubah Data</button>
                
                </form>    
                </div>
            </div>
        </div>
    </div>


<?= $this->endSection(); ?>