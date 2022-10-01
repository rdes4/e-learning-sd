
<?= $this->extend('v_guru/layout/default'); ?>


<?= $this->section('title'); ?>

Detail Tugas

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="row">

    <div class="col-md-8">
    <a href="<?=base_url('detailguru/showDetailMateri/'.$materi->id_materi)?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0 text-primary font-weight-bold">Tugas</h6>
            </div>
            <div class="card-body">
            <form action="<?=base_url('detailguru/update_tugas/'.$tugas->id_tugas)?>" method="post" enctype="multipart/form-data">
                    
                    <?=csrf_field()?>
                    <input type="hidden" name="id_detail_kelas" value="<?= $detailKelas->id_detail_kelas?>">
                    <input type="hidden" name="id_materi" value="<?=$materi->id_materi?>">
                    <input type="hidden" name="id_tugas" value="<?= $tugas->id_tugas ?>">
                    
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
                        <label for="judul_tugas">Judul Tugas</label>

                        <input type="text" class="form-control <?=($validation->hasError('judul_tugas')) ? 'is-invalid' : '';?>" name="judul_tugas" id="judul_tugas" value="<?= $tugas->judul_tugas ?>"> 
                        <div class="invalid-feedback">
                            <?=$validation->getError('judul_tugas')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="isi_tugas">Isi Tugas</label>
                        <textarea class="form-control" name="isi_tugas" id="isi_tugas" rows="3"><?= $tugas->isi_tugas ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="file_tugas">File atau Foto Tugas (Jika Ada)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file_tugas">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>

                    <input type="hidden" name="file_uploads_lama" value="<?= $tugas->file_tugas ?>">

                    <div class="form-group">
                        <label for="tanggal_kumpul">Batas Kumpul</label>
                        <input class="form-control" type="date" name="tanggal_kumpul" id="tanggal_kumpul" value="<?= $tugas->tanggal_kumpul ?>">
                    </div>
              
                    <button type="submit" class="btn btn-primary btn-add-siswa" name="add"><i class="fas fa-plus-circle"></i> Ubah Tugas</button>
                
                </form>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Siswa Yang Sudah Mengumpulkan</h6>
            </div>
            <div class="card-body">
                <table class="table" id="tabel_tugas_siswa">
                    <thead>
                        <tr>
                        <!-- <th scope="col">No.</th> -->
                        <th scope="col">Nama</th>
                        <th scope="col">File Tugas</th>
                        <th scope="col">Nilai Saat Ini</th>
                        <th scope="col">Jawaban Teks Online</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($tugas_siswa == '') : ?>
                    
                    <?php else : ?>

                    <?php foreach($tugas_siswa as $data): ?>
                        <tr>
                            <!-- <th scope="row">1</th> -->
                            <td><?=$data['nama_siswa']?></td>
                            <td>
                                <?php if($data['file_tugas_siswa'] != '')  : ?>
                                    
                                    <a href="<?=base_url()?>/file_uploads/file_tugas_siswa/<?=$data['file_tugas_siswa']?>" target="_blank">
                                        <img src="<?=base_url()?>/file_uploads/file_tugas_siswa/<?=$data['file_tugas_siswa']?>" alt="" style="max-height: 100px;">
                                    </a>
                                <?php endif ?>
                            </td>
                            <td><?= $data['nilai_tugas_siswa'] ?></td>

                            <td>
                                <!-- <textarea class="form-control" name="isi_tugas_siswa" rows="3" readonly><?= $data['isi_tugas_siswa'] ?></textarea> -->
                                <a class="btn btn-info" href="#" data-item="<?= $data['isi_tugas_siswa'] ?>" data-toggle="modal" data-target="#detailTugas<?=$data['id_tugas_siswa']?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Detail
                                </a>
                                    <div class="modal fade" id="detailTugas<?=$data['id_tugas_siswa']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Tugas Siswa</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="summernote">
                                                    <?= $data['isi_tugas_siswa'] ?>
                                                </div>
                                                </textarea>
                                            </div>
                                                <script>
                                                    CKEDITOR.replace( 'detail_tugas' );
                                                </script>
                                                <div class="modal-footer">
                                                <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <form action="<?=base_url('detailguru/updateNilaiSiswa')?>" method="POST">
                            <td>
                                <input type="hidden" name="id_detail_kelas" value="<?= $detailKelas->id_detail_kelas?>">
                                <input type="hidden" name="id_materi" value="<?=$materi->id_materi?>">
                                <input type="hidden" name="id_tugas" value="<?= $tugas->id_tugas ?>">
                                <input type="hidden" name="id_tugas_siswa" value="<?=$data['id_tugas_siswa']?>">
                                <div class="">
                                    <input style="width: 65px;" type="number" class="form-control" value="<?= $data['nilai_tugas_siswa'] ?>" name="nilai_tugas_siswa">
                                </div>
                                <button class="btn btn-success" type="submit">Ubah Nilai</button> </form>
                            </td>
                            <td>
                                <a href="<?= base_url('detailguru/downloadFileTugasSiswa/'.$data['id_tugas_siswa']) ?>" class="btn btn-google"> Unduh File</a>
                            </td>
                            
                        </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>