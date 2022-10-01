<?= $this->extend('layout/default'); ?>


<?= $this->section('title'); ?>

Data Kelas

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Kelas</h1>

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
                            <a href="<?=base_url('kelas/create')?>">
                                <button class="btn btn-primary"><i class="fas fa-user-plus"></i> Tambah Kelas</button>
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_kelas" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Daftar Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        <?php $i = 1;?>

                                        <?php foreach($kelas as $row) : ?>

                                        <tr>
                                            <td><?=$i;?></td>
                                            <td><?=$row['kelas']?></td>
                                            <td style="text-align: center;">
                                                <a href="<?=base_url('kelas/detailkelas/'.$row['id_kelas'])?>" class="btn btn-sm btn-info mr-1"><i class="fas fa-info-circle"></i> Detail</a>

                                                <a href="<?=base_url('kelas/editkelas/'.$row['id_kelas'])?>" class="btn btn-sm btn-warning mr-1"><i class="fas fa-edit"></i> Edit</a>

                                                <a href="<?=base_url('kelas/deletekelas/'.$row['id_kelas'])?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Ingin Menghapus Data ??');"><i class="fas fa-trash-alt"></i> Delete</a>
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

