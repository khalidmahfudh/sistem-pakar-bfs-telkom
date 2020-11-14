<div class="container">
    <nav class="title">
        <h1 class="h3 text-dark text-center">Tambah Data Gangguan Internet Fiber</h1>
    </nav>
    <!-- Page Heading -->
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">Form Tambah Data Gangguan</div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php
                        $kode = 201;

                        $data = array(
                            'class'        => 'form-control',
                            'name'        => 'solusi',
                            'id'          => 'solusi',
                            'value'       => set_value('solusi'),
                            'rows'        => '4',
                        );
                        ?>

                        <div class="form-group">
                            <label for="nama">Nama Gangguan</label>
                            <input type="text" class="form-control" id="namagangguan" name="namagangguan" autocomplete="off" value="<?= set_value('namagangguan'); ?>">
                            <small class="form-text text-danger"><i><?= form_error('namagangguan'); ?></i></small>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Kode Gangguan</label>
                            <select class="form-control" id="kodegangguan" name="kodegangguan">
                                <?php foreach ($gangguan as $g) : ?>
                                    <option disabled>P<?= $g['kode_gangguan']; ?></option>
                                <?php endforeach; ?>

                                <option checked>P<?= $g['kode_gangguan'] + 1 ?></option>
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