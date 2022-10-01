
<?= $this->extend('layout/default'); ?>


<?= $this->section('title'); ?>

Ubah Data Guru

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('guru')?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

<h1 class="h3 mb-4 text-gray-800">Ubah Data Guru</h1>


    <div class="row">
        <div class="col-md-8">

            <div class="card shadow mb-4">
                <div class="card-body">
                <form action="<?=base_url('guru/updateguru/'.$guru->id_guru)?>" method="post">
                    
                    <?=csrf_field()?>
                    <div class="form-group">
                        <label for="nip">Nomor Identitas Pegawai (NIP)</label>
                        <input type="number" class="form-control <?=($validation->hasError('nip')) ? 'is-invalid' : '';?>" name="nip" id="nip" value="<?=$guru->nip?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('nip')?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru</label>
                        <input type="text" class="form-control <?=($validation->hasError('nama_guru')) ? 'is-invalid' : '';?>" name="nama_guru" value="<?=$guru->nama_guru?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('nama_guru')?>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="text" class="form-control" name="pass" value="<?=$guru->pass?>" readonly> 
                    </div>
              
                    <button type="submit" class="btn btn-primary btn-add-siswa" name="add">Ubah Data</button>
                
                </form>    
                </div>
            </div>
        </div>
    </div>


<?= $this->endSection(); ?>