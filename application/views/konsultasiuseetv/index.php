<!-- Begin Page Content -->

<!-- Page Heading -->

<nav class="title">
    
<h1 class="h3 mb-4 text-gray-800 text-center">Konsultasi <?= $title; ?></h1>
</nav>

<div class="container bg-div pt-3 pb-3 py-5" style="height: 80%">
    <div class="row">
        <a href="<?= base_url('konsultasiuseetv/diagnosa/first');  ?>" class="btn1-signal btn btn-danger btn-lg text-light my-4 mx-auto"><i class="fas fa-stethoscope"></i> DIAGNOSA SEKARANG</a>
    </div>

    <?php $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
    $i = 0; ?>

    <div class="row">
        <div class="list-group mx-auto my-2">
            <button type="button" class="btn2-signal btn btn-danger btn-lg text-center list-gangguan"><i class="fas fa-list"></i> LIST GANGGUAN</button>
            <div class="list-wrap animated--grow-in">
                <?php foreach ($gangguan as $g) : ?>
                    <a href="<?= base_url('konsultasiuseetv/detail/' . $g['id']); ?>" class="list-group-item list-group-item-action list-group-item-<?= $colors[$i++]; ?> text-gray-900"><?= $g['nama_gangguan']; ?></a>
                    <?php if ($i == 7) $i = 0; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row">
            <img src="<?= base_url('assets/img/useetv2.png') ?>" alt="logo" class="img-signal logo-hover mx-auto d-block my-4 mx-auto">
    </div>

</div>


</div>
<!-- End of Main Content -->