
<!-- Begin Page Content -->

<!-- Page Heading -->

<nav class="title">
    <h1 class="h3 mb-4 text-gray-800 text-center">Diagnosa <?= $title; ?></h1>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <ul class="list-group">
                <li class="list-group-item text-danger border-left-danger">
                    KETERANGAN : Jika ada pernyataan tidak dijawab, maka sama saja anda memilih "TIDAK".
                </li>
            </ul>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md" id="card-container">
            <div class="card border-info mb-3">
                <div class="card-body text-info Qbc">
                    <h4 class="card-title">Pertanyaan :</h4><hr>
                    <?php $i=0; ?>
                    <form method="post" action="<?= base_url('konsultasiuseetv/diagnosa/transition'); ?>" class="form">
                        <?php foreach ($question as $que) : ?>
                            
                        <div class="form-wrap">
                            <div class="row">
                                <h4 class="card-text my-2 ml-2"><?= ++$i; ?>. Apakah <?= $que['nama_gejala']; ?> ?</h4>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" id="label">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio<?= $que['id'] ?>1"  style="height: 30px; width: 30px;" value="<?= $que['kode_gejala'] ?>-1-1" checked>
                                    <h5>YA</h5>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">                 
                                    <input class="form-check-input" type="radio" name="radio1" id="radio<?= $que['id'] ?>2"  style="height: 30px; width: 30px;" value="<?= $que['kode_gejala'] ?>-2-1">
                                    <h5>TIDAK</h5>
                                </label>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <hr class="mt-4">
                        <button type="submit" class="btn-diagnosis my-3" style="display: block;">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<!-- End of Main Content -->