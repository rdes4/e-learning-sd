<?= $this->extend('layout/default'); ?>


<?= $this->section('title'); ?>

Data Siswa

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Siswa</h1>

    <!-- Flashdata -->
    <?php if(session()->get('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?=session()->getFlashdata('message')?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

                    <div class="card shadow mb-4">

                        <div class="card-header py-3" style="background: rgb(157,157,255);
background: linear-gradient(90deg, rgba(157,157,255,1) 0%, rgba(0,212,255,1) 100%);">
                            <a href="<?=base_url('siswa/create')?>">
                                <button class="btn btn-primary"><i class="fas fa-user-plus"></i> Tambah Siswa</button>
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_siswa" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Nomor Telepon</th>
                                            <th>Tempat Tanggal Lahir</th>
                                            <th>Password Akun</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        <?php $i = 1;?>

                                        <?php foreach($siswa as $row) : ?>

                                        <tr>
                                            <td><?=$i;?></td>
                                            <td><?=$row['nis']?></td>
                                            <td><?=$row['nama_siswa']?></td>
                                            <td><?=$row['kelas']?></td>
                                            <td>62<?=$row['no_telp']?></td>
                                            <td><?=$row['tempat_lahir_siswa']?>, <?=date("d-m-Y", strtotime($row['tanggal_lahir_siswa']))?></td>
                                            <td><?=$row['pass']?></td>
                                            <td>
                                                <a href="<?=base_url('siswa/editsiswa/'.$row['id_siswa'])?>" class="btn btn-sm btn-warning mr-1"><i class="fas fa-edit"></i> Edit</a>

                                                <a href="<?=base_url('siswa/deletesiswa/'.$row['id_siswa'])?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Ingin Menghapus Data ??');"><i class="fas fa-trash-alt"></i> Delete</a>
                                            </td>
                                        </tr>

                                        <?php
                                          $i++;  
                                        ?>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>

