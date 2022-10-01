
<?= $this->extend('v_guru/layout/default'); ?>


<?= $this->section('title'); ?>

Ubah Pertanyaan

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<a href="<?=base_url('detailguru/showDetailKuis/'.$id_kuis.'/'.$detailKelas->id_detail_kelas.'/'.$materi->id_materi)?>" class="btn btn-primary mb-2"><i class="fas fa-angle-left"></i> Kembali</a>

<div class="row">
<div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex">
                    <div class="bd-highlight"><h6 class="font-weight-bold text-primary">Ubah Pertanyaan</h6></div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?=base_url('detailguru/update_kuis')?>" method="post">
                    <?=csrf_field()?>
                    <input type="hidden" name="id_detail_kuis" id="" value="<?=$kuis->id_detail_kuis?>">
                    <input type="hidden" name="id_kuis" value="<?=$id_kuis?>">
                    <input type="hidden" name="id_detail_kelas" value="<?= $detailKelas->id_detail_kelas?>">
                    <input type="hidden" name="id_materi" value="<?=$materi->id_materi?>">

                    <div class="form-group">
                        <label for="soal_kuis">Soal</label>
                        <input type="text" name="soal_kuis" class="form-control <?=($validation->hasError('soal_kuis')) ? 'is-invalid' : '';?>" id="soal_kuis" value="<?=$kuis->soal_kuis?>">
                        <div class="invalid-feedback" >
                            <?=$validation->getError('soal_kuis')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jawaban1">Pilihan A</label>
                        <input type="text" name="jawaban1" class="form-control <?=($validation->hasError('jawaban1')) ? 'is-invalid' : '';?>" id="jawaban1" value="<?=$kuis->jawaban1?>">
                        <div class="invalid-feedback">
                            <?=$validation->getError('jawaban1')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jawaban2">Pilihan B</label>
                        <input type="text" name="jawaban2" class="form-control <?=($validation->hasError('jawaban2')) ? 'is-invalid' : '';?>" id="jawaban2" value="<?=$kuis->jawaban2?>">
                        <div class="invalid-feedback">
                            <?=$validation->getError('jawaban2')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jawaban3">Pilihan C</label>
                        <input type="text" name="jawaban3" class="form-control <?=($validation->hasError('jawaban3')) ? 'is-invalid' : '';?>" id="jawaban3" value="<?=$kuis->jawaban3?>">
                        <div class="invalid-feedback">
                            <?=$validation->getError('jawaban3')?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="mb-0" for="kunci_jawaban">Kunci Jawaban</label>
                            <select class="form-control" id="kunci_jawaban" name="kunci_jawaban">
                                <?php if($kuis->kunci_jawaban == 'a') :?>
                                    <option value="a" selected>A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                <?php elseif($kuis->kunci_jawaban == 'b'): ?>
                                    <option value="a">A</option>
                                    <option value="b" selected>B</option>
                                    <option value="c">C</option>
                                <?php elseif($kuis->kunci_jawaban == 'c'): ?>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c" selected>C</option>
                                <?php endif ?>
                            </select>
                    </div>

                    <button class="btn btn-sm btn-success" type="submit">
                        <i class="fas fa-plus"></i> Ubah Soal
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>