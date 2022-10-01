
<?= $this->extend('v_guru/layout/default'); ?>


<?= $this->section('title'); ?>

Detail Kuis

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('detailguru/showDetailMateri/'.$materi->id_materi)?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

<div class="row">
    <div class="col">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0 text-primary font-weight-bold">Kuis</h6>
            </div>
            <div class="card-body">
                    
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
                
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex">
                    <div class="bd-highlight"><h6 class="font-weight-bold text-primary">Daftar Pertanyaan</h6></div>
                </div>
            </div>
            <?php if($kuis == '') : ?>
            <div class="card-body">

            <h5>DATA KOSONG</h5>
            </div>
            <?php else : ?>
            <div class="card-body">
                <?php foreach($kuis as $row) : ?>

                <p><?= $row['soal_kuis']; ?></p>
                <ol type="A">
                    <li><?= $row['jawaban1']; ?></li>
                    <li><?= $row['jawaban2']; ?></li>
                    <li><?= $row['jawaban3']; ?></li>
                </ol>
                <p>Kunci Jawaban : <?= $row['kunci_jawaban']; ?></p>

                <div class="d-flex bd-highlight">
                    <div class="pr-2 bd-highlight"><a href="<?=base_url('detailguru/editKuis/'.$row['id_detail_kuis'].'/'.$id_kuis.'/'.$detailKelas->id_detail_kelas.'/'.$materi->id_materi)?>" class="btn btn-sm btn-warning">Ubah</a></div>
                    <div class="bd-highlight"><a href="<?=base_url('detailguru/delete_detail_kuis/'.$row['id_detail_kuis'].'/'.$id_kuis.'/'.$detailKelas->id_detail_kelas.'/'.$materi->id_materi)?>" onclick="return confirm('Yakin ingin menghapus soal kuis ini?');" class="btn btn-sm btn-danger">Hapus</a></div>
                </div>
    
                <hr>
        
                <?php endforeach ?>
            </div>
            <?php endif ?>
            
        </div>
    </div>
    
    <!-- Tambah Soal kuis -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex">
                    <div class="bd-highlight"><h6 class="font-weight-bold text-primary">Tambah Pertanyaan</h6></div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?=base_url('detailguru/save_kuis')?>" method="post">
                    <?=csrf_field()?>
                    <input type="hidden" name="id_kuis" value="<?=$id_kuis?>">
                    <input type="hidden" name="id_detail_kelas" value="<?= $detailKelas->id_detail_kelas?>">
                    <input type="hidden" name="id_materi" value="<?=$materi->id_materi?>">

                    <div class="form-group">
                        <label for="soal_kuis">Soal</label>
                        <input type="text" name="soal_kuis" class="form-control <?=($validation->hasError('soal_kuis')) ? 'is-invalid' : '';?>" id="soal_kuis" value="<?=old('soal_kuis')?>">
                        <div class="invalid-feedback" >
                            <?=$validation->getError('soal_kuis')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jawaban1">Pilihan A</label>
                        <input type="text" name="jawaban1" class="form-control <?=($validation->hasError('jawaban1')) ? 'is-invalid' : '';?>" id="jawaban1" value="<?=old('jawaban1')?>">
                        <div class="invalid-feedback">
                            <?=$validation->getError('jawaban1')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jawaban2">Pilihan B</label>
                        <input type="text" name="jawaban2" class="form-control <?=($validation->hasError('jawaban2')) ? 'is-invalid' : '';?>" id="jawaban2">
                        <div class="invalid-feedback">
                            <?=$validation->getError('jawaban2')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jawaban3">Pilihan C</label>
                        <input type="text" name="jawaban3" class="form-control <?=($validation->hasError('jawaban3')) ? 'is-invalid' : '';?>" id="jawaban3">
                        <div class="invalid-feedback">
                            <?=$validation->getError('jawaban3')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="mb-0" for="kunci_jawaban">Kunci Jawaban</label>
                            <select class="form-control" id="kunci_jawaban" name="kunci_jawaban">
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                            </select>
                    </div>

                    <button class="btn btn-sm btn-success" type="submit">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- List Nilai Kuis -->
<?php if($nilai_kuis_siswa == '') : ?>
<?php else : ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Siswa Yang Sudah Mengerjakan</h6>
            </div>
            <div class="card-body">
                <table class="table" id="tabel_nilai_kuis_siswa">
                    <thead>
                        <tr>
                        <!-- <th scope="col">No.</th> -->
                        <th scope="col">Nama</th>
                        <th scope="col">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($nilai_kuis_siswa as $data): ?>
                        <tr>
                            <!-- <th scope="row">1</th> -->
                            <td ><?=$data['nama_siswa']?></td>
                            <td><?= $data['nilai'] ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif ?>



<?= $this->endSection(); ?>