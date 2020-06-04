<?php  

for ($i=0; $i < count($questions); $i++) { 
    $theQuestions[$i] = array_slice($questions[$i],3);
}

$checked = $kode;

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
            <div class="card border-info mb-3" style="">
                <form method="post" action="<?= base_url('konsultasitelepon/diagnosa/result'); ?>" class="form">        
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
                                            <label class="form-check-label" id="label">
                                                <input class="form-check-input mr-3" type="checkbox" name="<?= $i.$j; ?>" id="<?= $i.$j ?>"  style="height: 30px; width: 30px; display: inline-block;" value="<?= $i.'-'.$j; ?>" <?php if($checked == $csq[1]) echo "checked"; ?>>
                                                <h4 class="ml-4 mt-1"><?= $j++; ?>.apakah <?= $csq[0]; ?>?</h4>
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


