<div class="container">
    <nav class="title">
        <h1 class="h3 text-dark text-center">Ubah Data Gangguan Televisi Interaktif (UseeTV)</h1>
    </nav>
    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header bg-dark text-white">Form Ubah Data Gangguan</div>
                <div class="card-body">

                    <?php
                    $data = array(
                        'class'        => 'form-control',
                        'name'        => 'solusi',
                        'id'          => 'solusi',
                        'value'       => $gangguan['solusi_gangguan'],
                        'rows'        => '4',
                    );
                    ?>

                    <form action="" method="post">

                        <input type="hidden" name="id" value="<?= $gangguan['id']; ?>">

                        <div class="form-group">
                            <label for="nama">Kode Gangguan</label>
                            <input type="text" class="form-control" id="kodegangguan" name="kodegangguan" autocomplete="off" value="P<?= $gangguan['kode_gangguan']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Gangguan</label>
                            <input type="text" class="form-control" id="namagangguan" name="namagangguan" autocomplete="off" value="<?= $gangguan['nama_gangguan']; ?>">
                            <small class="form-text text-danger"><i><?= form_error('namagangguan'); ?></i></small>
                        </div>

                        <div class="form-group">
                            <label for="solusi">Solusi</label>
                            <?= form_textarea($data); ?>
                            <small class="form-text text-danger"><i><?= form_error('solusi'); ?></i></small>
                        </div>

                        <div class="footer">
                            <a href="<?= base_url('manageuseetv/gangguan'); ?>" class="btn btn-outline-dark">Kembali</a>
                            <button type="submit" name="ubah" class="btn btn-dark float-right">Ubah Data Gangguan</button>
                        </div>

                    </form>

                </div>
            </div>



        </div>
    </div>

</div>
</div>