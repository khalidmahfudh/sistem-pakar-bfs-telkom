<?php

$kode_awal = "201";
$kode_akhir = end($gangguan)['kode_gangguan'];

$kode_now =  $kode_akhir + 1;

for ($i = 0; $i < count($gangguan); $i++) {

    if ($kode_awal != $gangguan[$i]['kode_gangguan']) {
        $kode_now = $kode_awal;
        break;
    }
    $kode_awal++;
}

?>

<div class="container">
    <!-- Page Heading -->
    <nav class="title">

        <h1 class="h3 text-dark text-center">Tambah Data Gangguan Internet Fiber</h1>
    </nav>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">Form Tambah Data Gangguan</div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php

                        $data = array(
                            'class'        => 'form-control',
                            'name'        => 'solusi',
                            'id'          => 'solusi',
                            'value'       => set_value('solusi'),
                            'rows'        => '4',
                        );
                        ?>

                        <div class="form-group">
                            <label for="namagangguan">Nama Gangguan</label>
                            <input type="text" class="form-control" id="namagangguan" name="namagangguan" autocomplete="off" value="<?= set_value('namagangguan'); ?>">
                            <small class="form-text text-danger"><i><?= form_error('namagangguan'); ?></i></small>
                        </div>

                        <div class="form-group">
                            <label for="kodegangguan">Kode Gangguan</label>

                            <select class="form-control" id="kodegangguan" name="kodegangguan">
                                <option>P<?= $kode_now; ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="solusi">Solusi</label>
                            <?= form_textarea($data); ?>
                            <small class="form-text text-danger"><i><?= form_error('solusi'); ?></i></small>
                        </div>

                        <div class="footer">
                            <a href="<?= base_url('manageinternet/gangguan'); ?>" class="btn btn-outline-dark">Kembali</a>
                            <button type="submit" name="tambah" class="btn btn-dark float-right">Tambah Data Gangguan</button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->