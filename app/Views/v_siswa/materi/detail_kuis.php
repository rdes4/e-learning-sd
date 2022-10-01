
<?= $this->extend('v_siswa/layout/default'); ?>


<?= $this->section('title'); ?>

Detail Kuis

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('detailsiswa/showDetailMateriForSiswa/'.$materi->id_materi)?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

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

<!-- Hasil Kuis -->
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex">
                    <div class="bd-highlight"><h6 class="font-weight-bold text-primary">Daftar Pertanyaan</h6></div>
                </div>
            </div>
            <div class="card-body">
            <?php 
                $nilai_siswa = getNilaiKuisSiswa(session()->get('id_siswa'), $id_kuis);   
            ?>
            <?php if($nilai_siswa != '') : ?>
                <form action="<?=base_url('detailsiswa/updateKuisSiswa/')?>" method="post">
                <input type="hidden" name="id_nilai_kuis" value="<?=$nilai_siswa->id_nilai_kuis?>"> 
                <input type="hidden" name="id_materi" value="<?=$materi->id_materi?>"> 
                <input type="hidden" name="id_kuis" id="" value="<?=$id_kuis?>"> 
                <?php foreach($kuis as $row) : ?>
                    <p><?= $row['soal_kuis']; ?></p>
                    <ol type="A">
                        <li><input required type="radio" value="a" name="jawaban[<?=$row['id_detail_kuis']?>]"> <?=$row['jawaban1']?></li>
                        <li><input required type="radio" value="b" name="jawaban[<?=$row['id_detail_kuis']?>]"> <?=$row['jawaban2']?></li>
                        <li><input required type="radio" value="c" name="jawaban[<?=$row['id_detail_kuis']?>]"> <?=$row['jawaban3']?></li>
                    </ol>
                <?php endforeach ?>
                <button type="submit" onclick="return confirm('Yakin ingin mengumpulkan kuis?');" class="btn btn-sm btn-primary">Kumpulkan</button>
                </form>
            <?php else : ?>
                <form action="<?=base_url('detailsiswa/submitKuisSiswa/')?>" method="post">
                <input type="hidden" name="id_materi" value="<?=$materi->id_materi?>"> 
                <input type="hidden" name="id_kuis" id="" value="<?=$id_kuis?>"> 
                <?php foreach($kuis as $row) : ?>
                    <p><?= $row['soal_kuis']; ?></p>
                    <ol type="A">
                        <li><input required type="radio" value="a" name="jawaban[<?=$row['id_detail_kuis']?>]"> <?=$row['jawaban1']?></li>
                        <li><input required type="radio" value="b" name="jawaban[<?=$row['id_detail_kuis']?>]"> <?=$row['jawaban2']?></li>
                        <li><input required type="radio" value="c" name="jawaban[<?=$row['id_detail_kuis']?>]"> <?=$row['jawaban3']?></li>
                    </ol>
                <?php endforeach ?>
                <button type="submit" onclick="return confirm('Yakin ingin mengumpulkan kuis?');" class="btn btn-sm btn-primary">Kumpulkan</button>
                </form>
            <?php endif ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>