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
                    KETERANGAN : Pilih jawaban yang menurut anda lebih tepat.
                </li>
            </ul>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md" id="card-container">
            <div class="card border-info mb-3">
                <div class="card-body text-info Qbc">
                    <h4 class="card-title">Pertanyaan :</h4>
                    <hr>
                    <form method="post" action="<?= base_url('konsultasiinternet/diagnosa/transition'); ?>" class="form">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $i = 0;
                                ?>
                                <?php foreach ($questions as $question) : ?>

                                    <div class="form-wrap">
                                        <div class="row">
                                            <h4 class="card-text my-2 ml-2"><?= ++$i; ?>. Apakah <?= $question[0]; ?> ?</h4>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" id="label">
                                                <input class="form-check-input" type="radio" name="radio<?= $i; ?>" id="radio<?= $i; ?>" style="height: 30px; width: 30px;" value="<?= $question[0]; ?>-<?= $question[1]; ?>-1">
                                                <h5>YA</h5>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="radio<?= $i; ?>" id="radio<?= $i; ?>" style="height: 30px; width: 30px;" value="<?= $question[0]; ?>-<?= $question[1]; ?>-2" checked>
                                                <h5>TIDAK</h5>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>

                        <button type="submit" class="btn-diagnosis my-3" style="display: block;">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<!-- End of Main Content -->