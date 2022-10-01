<?= $this->extend('layout/default'); ?>


<?= $this->section('title'); ?>

Data Siswa

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('kelas')?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Kelas</h1>

    <!-- Flashdata -->
    <?php if(session()->get('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=session()->getFlashdata('message')?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

<?php if ($detail_kelas == "") : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
            DATA DETAIL KELAS BELUM DITAMBAHKAN!!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <form action="<?=base_url('kelas/insertdetailkelas')?>" method="post">
                    
                    <?=csrf_field()?>

                    <input type="hidden" name="id_kelas" value="<?=$kelas->id_kelas?>">
                    <div class="form-group">
                        <label for="kelas">Nama Kelas</label>
                        <input type="text" class="form-control <?=($validation->hasError('kelas')) ? 'is-invalid' : '';?>" name="kelas" id="kelas" value="<?=$kelas->kelas?>" readonly> 
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
                            <?php endif;?>

                        <?php endforeach; ?>
                        </select> 
                    </div>
                    <button type="submit" class="btn btn-primary btn-icon-split" name="add">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Detail</span>
                    </button>
                
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php else : ?>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Kelas <?=$detail_kelas->kelas?>
                            </div>
                            <div class="text-sm mb-0 text-gray-800">Wali Kelas : <?= $detail_kelas->nama_guru ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Total Murid : <?=$siswa?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MAPEL UMUM -->
    <div class="row">
        <div class="col-xl-8 col-md-8  mb-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                <?php $i = 1;?>
                <?php if(empty($mapel_umum)) :?>
                DATA KOSONG
                <?php else : ?>
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mata Pelajaran Umum</th>
                    <th scope="col">Beri Akses</th>
                    <th scope="col">Hapus Akses</th>
                    </tr>
                </thead>
                <?php foreach($mapel_umum as $data) : ?>
                <tbody>
                    <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$data['mata_pelajaran']?></td>
                    <td >
                        <a href="<?=base_url('kelas/editaksesmapel/'.$detail_kelas->id_kelas.'/'.$data['id_mapel'].'/'.$detail_kelas->id_guru)?>">
                        <button class="btn btn-success" <?= cekMapel($detail_kelas->id_kelas, $data['id_mapel']) ?>><i class="fas fa-check"></i></button>
                        </a>
                    </td>
                    <td >
                        <a href="<?=base_url('kelas/editaksesmapel/'.$detail_kelas->id_kelas.'/'.$data['id_mapel']).'/'.$detail_kelas->id_guru?>">
                            <button class="btn btn-danger" <?php if (cekMapel($detail_kelas->id_kelas, $data['id_mapel']) != "disabled") {
                            echo "disabled";
                            } ?>><i class="fas fa-trash"></i></button>
                        </a>
                    </td>
                    </tr>
                </tbody>
                <?php
                    $i++;  
                ?>
                <?php endforeach; ?>
                <?php endif ;?>
                </table>
                   
                </div>
            </div>
        </div>
    </div>
    
    <!-- MAPEL KHUSUS -->
    <div class="row">
        <div class="col-xl-8 col-md-8  mb-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                <?php $i = 1;?>
                
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mata Pelajaran Khusus</th>
                    <th scope="col">Guru</th>
                    <th scope="col">Beri Akses</th>
                    <th scope="col">Hapus Akses</th>
                    </tr>
                </thead>
                <?php foreach($mapel_khusus as $data) : ?>
                <tbody>
                    <tr>
                    <th scope="row"><?=$i?></th>
                    <td>
                        <?=$data['mata_pelajaran']?>
                    </td>
                    <td>

                    <?php 
                        $cekMapel =  cekMapelAgain($detail_kelas->id_kelas, $data['id_mapel']);
                        if ($cekMapel == 1) :
                        $getDetailKelas = getDetailKelas($detail_kelas->id_kelas, $data['id_mapel']);
                    ?>
                    
                        <input type="text" class="form-control" value="<?=$getDetailKelas->nama_guru?>" readonly>
                    <?php 
                        else: 
                    ?>
                        <form action="<?=base_url('kelas/editaksesmapel/'.$detail_kelas->id_kelas.'/'.$data['id_mapel'])?>" method="POST">

                        <div class="form-group">
                            <select class="form-control" name="id_guru" style="min-width: 150px;">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach($guru as $data_guru) : ?>

                                <option value="<?=$data_guru['id_guru']?>" name="id_guru" ><?=$data_guru['nama_guru']?></option>

                            <?php endforeach; ?>
                            </select>
                        </div>
                    <?php 
                        endif 
                    ?>
                        
                    </td>
                    <td >
                        <button type="submit" class="btn btn-success" <?= cekMapel($detail_kelas->id_kelas, $data['id_mapel']) ?>><i class="fas fa-check"></i></button>

                        </form> 
                    </td>
                    <td >
                        <a href="<?=base_url('kelas/editaksesmapel/'.$detail_kelas->id_kelas.'/'.$data['id_mapel'].'/'.$detail_kelas->id_guru)?>">
                            <button class="btn btn-danger" <?php if (cekMapel($detail_kelas->id_kelas, $data['id_mapel']) != "disabled") {
                            echo "disabled";
                            } ?>><i class="fas fa-trash"></i></button>
                        </a>
                    </td>
                    </tr>
                </tbody>
                <?php
                    $i++;  
                ?>
                <?php endforeach; ?>
                </table>
                   
                </div>
            </div>
        </div>
    </div>
    
<?php endif ?>


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>

