<?= $this->extend('layout/default'); ?>


<?= $this->section('title'); ?>

Data Guru

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Guru</h1>

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

                        <div class="card-header py-3">
                            <a href="<?=base_url('guru/create')?>">
                                <button class="btn btn-primary"><i class="fas fa-user-plus"></i> Tambah Guru</button>
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_guru" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Password Akun</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        <?php $i = 1;?>

                                        <?php foreach($guru as $row) : ?>

                                        <tr>
                                            <td><?=$i;?></td>
                                            <td><?=$row['nip']?></td>
                                            <td><?=$row['nama_guru']?></td>
                                            <td><?=$row['pass']?></td>
                                            <td style="text-align: center;">
                                                <a href="<?=base_url('guru/editguru/'.$row['id_guru'])?>" class="btn btn-sm btn-warning mr-1"><i class="fas fa-edit"></i> Edit</a>

                                                <a href="<?=base_url('guru/deleteguru/'.$row['id_guru'])?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Ingin Menghapus Data ??');"><i class="fas fa-trash-alt"></i> Delete</a>
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

