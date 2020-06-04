<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Gangguan Telepon Rumah</h1>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">Form Tambah Data Gangguan</div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php
                        $kode = 101;

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
                            <button type="button" class="close mr-2 float-left" title="detail">
                                <a href="<?= base_url('managetelepon/gangguan'); ?>" style="text-decoration: none; color: black; font-size: 40px;">&#16;</a>
                            </button>
                            <button type="submit" name="tambah" class="btn btn-outline-dark float-right">Tambah Data Gangguan</button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->