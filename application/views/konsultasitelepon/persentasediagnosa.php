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
                    KETERANGAN : Jawablah Pertanyaan dibawah berdasarkan keyakinan terjadinya gejala.
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
                                                <div class="d-flex align-items-center radio-wrapper">
                                                    <label class="container">Ya
                                                        <?php if ($checked == $csq[1]) : ?>
                                                            <input type="radio" checked="checked" name="radio<?= $i . $j ?>" id="radio<?= $i . $j ?>" value="2">
                                                        <?php else : ?>
                                                            <input type="radio" name="radio<?= $i . $j ?>" id="radio<?= $i . $j ?>" value="2">
                                                        <?php endif; ?>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container">Tidak Tau
                                                        <input type="radio" name="radio<?= $i . $j ?>" id="radio<?= $i . $j ?>" value="1">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container">Tidak
                                                        <?php if ($checked != $csq[1]) : ?>
                                                            <input checked="checked" type="radio" name="radio<?= $i . $j ?>" id="radio<?= $i . $j ?>" value="0">
                                                        <?php else : ?>
                                                            <input type="radio" name="radio<?= $i . $j ?>" id="radio<?= $i . $j ?>" value="0">
                                                        <?php endif; ?>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php $j++;
                            endforeach;
                            ?>
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