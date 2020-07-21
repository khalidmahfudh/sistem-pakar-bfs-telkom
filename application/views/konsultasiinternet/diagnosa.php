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
                    KETERANGAN : Jawablah pernyataan dibawah ini dengan tepat!
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
                    <form method="post" action="<?= base_url('konsultasiinternet/transition'); ?>" class="form">
                        <div class="form-wrap">
                            <div class="row">
                                <h4 class="card-text my-2 ml-2"><?= $number; ?>. Apakah <?= $question['nama_gejala']; ?> ?</h4>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" id="label">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio<?= $question['id'] ?>1" style="height: 30px; width: 30px;" value="<?= $question['kode_gejala'] ?>:1:<?= $root; ?>:<?= $number; ?>" checked>
                                    <h5>YA</h5>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="radio1" id="radio<?= $question['id'] ?>2" style="height: 30px; width: 30px;" value="<?= $question['kode_gejala'] ?>:2:<?= $root; ?>:<?= $number; ?>">
                                    <h5>TIDAK</h5>
                                </label>
                            </div>
                        </div>
                        <div class="code">
                            <code>
                                OPEN [ <?php
                                        foreach ($_SESSION['open_'] as $open) {
                                        ?>G<?= $open; ?>, <?php
                                                        }
                                                            ?> ]
                            <br><br>
                            CLOSED [ <?php
                                        foreach ($_SESSION['closed_'] as $open) {
                                        ?>G<?= $open; ?>, <?php
                                                        }
                                                            ?> ]
                            </code>
                        </div>
                        <hr class="mt-4">
                        <button type="submit" class="btn-diagnosis my-3">SUBMIT</button>
                        <a href="<?= base_url('konsultasiinternet/reset'); ?>" class="ml-2">Reset Soal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<!-- End of Main Content -->