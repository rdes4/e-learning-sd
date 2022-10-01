
<?= $this->extend('layout/default'); ?>


<?= $this->section('title'); ?>

Edit Data Siswa

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<a href="<?=base_url('siswa')?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>
<h1 class="h3 mb-4 text-gray-800">Edit Data Siswa</h1>


    <div class="row">
        <div class="col-md-8">

            <div class="card shadow mb-4">
                <div class="card-body">
                <form action="<?=base_url('siswa/updatesiswa/'.$siswa->id_siswa)?>" method="post">
                    
                    <?=csrf_field()?>
                    <div class="form-group">
                        <label for="nis">Nomor Induk Siswa</label>
                        <input type="number" class="form-control <?=($validation->hasError('nis')) ? 'is-invalid' : '';?>" name="nis" id="nis" value="<?=$siswa->nis?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('nis')?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control <?=($validation->hasError('nama_siswa')) ? 'is-invalid' : '';?>" name="nama_siswa" value="<?=$siswa->nama_siswa?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('nama_siswa')?>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="tempat_lahir_siswa">Tempat Lahir</label>
                        <input type="text" class="form-control <?=($validation->hasError('tempat_lahir_siswa')) ? 'is-invalid' : '';?>" name="tempat_lahir_siswa" value="<?=$siswa->tempat_lahir_siswa?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('tempat_lahir_siswa')?>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="tanggal_lahir_siswa">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir_siswa" value="<?=$siswa->tanggal_lahir_siswa?>"> 
                    </div>

                    <div class="form-group">
                        <label class="mb-0" for="no_telp">Nomor Telepon (kalau bisa nomor WA)</label>
                        <small id="no_telp" class="form-text text-muted mb-1">Masukkan nomor telepon tanpa angka nol(0) didepan. Contoh : 81285498002</small>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">+62</div>
                            </div>
                            <input type="number" class="form-control <?=($validation->hasError('no_telp')) ? 'is-invalid' : '';?>" name="no_telp" required placeholder="81XXXXXXX" value="<?=$siswa->no_telp?>"> 
                                <div class="invalid-feedback">
                                    <?=$validation->getError('no_telp')?>
                                </div>
                            
                        </div>
                        
                    </div>
                    
                    <?php 
                        $agama = array('Islam', 'Kristen Protestan', 'Katholik', 'Hindu', 'Buddha', 'Konghucu');
                    ?>

                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <select class="form-control" name="agama">
                            <?php foreach($agama as $data) : ?>
                                <?php if ($siswa->agama == $data) : ?>
                                    <option selected value="<?=$data?>"><?=$data?></option>
                                <?php else : ?>
                                    <option value="<?=$data?>"><?=$data?></option>
                                <?php endif; ?>
                                
                            <?php endforeach;?>
                        </select> 
                    </div>
                    
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" name="jk">
                                <?php if ($siswa->jk == "L") : ?>
                                    <option selected value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                <?php elseif($siswa->jk == "P") : ?>
                                    <option selected value="P">Perempuan</option>
                                    <option value="L">Laki-Laki</option>
                                <?php endif; ?>
                        </select> 
                    </div>
                
                    <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <select class="form-control" name="id_kelas">
                        <?php foreach($kelas as $data) : ?>

                            <?php if($siswa->id_kelas == $data['id_kelas']) : ?>
                                <option selected value="<?=$data['id_kelas']?>"><?=$data['kelas']?></option>
                            <?php else :?>
                                <option value="<?=$data['id_kelas']?>"><?=$data['kelas']?></option>
                            <?php endif;?>

                        <?php endforeach; ?>
                        </select> 
                    </div>
                
                    <?php
                        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $pass = substr(str_shuffle($data), 0, 5);
                    ?>
                
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="text" class="form-control" name="pass" value="<?=$siswa->pass?>" readonly> 
                    </div>
                
                    <button type="submit" class="btn btn-primary btn-add-siswa" name="add">Ubah Data</button>
                
                </form>    
                </div>
            </div>
        </div>
    </div>







<?= $this->endSection(); ?>