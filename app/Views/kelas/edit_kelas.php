
<?= $this->extend('layout/default'); ?>


<?= $this->section('title'); ?>

Ubah Data Kelas

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('kelas')?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

<h1 class="h3 mb-4 text-gray-800">Ubah Data Kelas</h1>


    <div class="row">
        <div class="col-md-8">

            <div class="card shadow mb-4">
                <div class="card-body">
                <form action="<?=base_url('kelas/updatekelas/'.$kelas->id_kelas)?>" method="post">
                    
                    <?=csrf_field()?>
                    <div class="form-group">
                        <label for="kelas">Nama Kelas</label>
                        <input type="text" class="form-control <?=($validation->hasError('kelas')) ? 'is-invalid' : '';?>" name="kelas" id="kelas" value="<?=$kelas->kelas?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('kelas')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id_guru">Wali Kelas</label>
                        <select class="form-control" name="id_guru">
                        <?php foreach($guru as $data) : ?>

                            <?php if($kelas->id_guru == $data['id_guru']) : ?>
                                <option selected value="<?=$data['id_guru']?>"><?=$data['nama_guru']?></option>
                            <?php else :?>
                                <option value="<?=$data['id_guru']?>"><?=$data['nama_guru']?></option>
                            <?php endif;?>

                        <?php endforeach; ?>
                        </select> 
                    </div>
              
                    <button type="submit" class="btn btn-primary btn-add-siswa" name="add">Ubah Data</button>
                
                </form>    
                </div>
            </div>
        </div>
    </div>


<?= $this->endSection(); ?>