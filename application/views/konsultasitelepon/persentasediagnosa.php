<?php
for ($i = 0; $i < count($questions); $i++) {
    $theQuestions[$i] = array_slice($questions[$i], 3);
}
$checked = $symptomCode;
?>

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
                <form method="post" action="<?= base_url('konsultasitelepon/result'); ?>" class="form">
                    <?php $i = 1; ?>
                    <?php foreach ($questions as $question) : ?>

                        <?php
                        $sliceQuestion = array_slice($question, 3);
                        $chunkSliceQuestion = array_chunk($sliceQuestion, 2);
                        ?>


                        <div class="form-wrap">
                            <h4 class="card-header text-gray-900 text-center mb-3">Menghitung Persentase Kemungkinan [ <?= $question[0]; ?> ]</h4>
                            <?php $j = 1; ?>
                            <?php foreach ($chunkSliceQuestion as $csq) : ?>
                                <div class="row ml-2">
                                    <div class="col-sm">
                                        <div class="form-check form-check">
                                            <label class="percenContainer form-check-label" id="label">
                                                <h4 class="mt-1 percenQuestions"><?= $j; ?>. apakah <?= $csq[0]; ?>?</h4>
                                                <div class="slideContainer d-flex align-items-center">
                                                    <?php if ($checked == $csq[1]) : ?>
                                                        <input type="range" min="0" max="2" id="myRange<?= $i . $j ?>" name="myRange<?= $i . $j++ ?>" class="slider myRange disabledInput" value="5" style="Background: linear-gradient(90deg, rgb(239, 71, 64)100%, rgb(214, 214, 214)100%);">
                                                    <?php else : ?>
                                                        <input type="range" min="0" max="2" id="myRange<?= $i . $j ?>" name="myRange<?= $i . $j++ ?>" class="slider myRange" value="0">
                                                    <?php endif; ?>
                                                    <span class="value"></span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    <div class="card-header d-flex justify-content-center mt-3">
                        <button type="submit" class="btn-diagnosis my-3" style="display: block;">SUBMIT</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


</div>
<!-- End of Main Content -->