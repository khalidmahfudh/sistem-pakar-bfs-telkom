<?php
$cf = [[0, 0.2, 0.4, 0.6, 0.8, 1], ['Tidak', 'Tidak Tau', 'Sedikit Yakin', 'Cukup Yakin', 'Yakin', 'Pasti']];
$cf_count = 6;

?>
<div class="container">
    <!-- Page Heading -->
    <nav class="title">
        <h1 class="h3 text-dark text-center">Tambah Data Gejala Telepon Rumah</h1>
    </nav>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">Form Tambah Data Gejala</div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php
                        $kode = 101;
                        ?>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Kode Gejala</label>
                            <select class="form-control" id="kodegejala" name="kodegejala">
                                <?php foreach ($gejala as $g) : ?>
                                    <option disabled>G<?= $g['kode_gejala']; ?></option>
                                <?php endforeach; ?>

                                <option checked>G<?= $g['kode_gejala'] + 1 ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Gejala</label>
                            <input type="text" class="form-control" id="namagejala" name="namagejala" autocomplete="off" value="<?= set_value('namagejala'); ?>">
                            <small class="form-text text-danger"><i><?= form_error('namagejala'); ?></i></small>
                        </div>

                        <div class="form-group">
                            <label for="cfpakar">CF Pakar</label>
                            <select class="form-control" id="cfpakar" name="cfpakar">
                                <?php for ($i = 0; $i < $cf_count; $i++) : ?>
                                    <?php if ($gejala['cf_pakar'] == $cf[0][$i]) : ?>
                                        <option value="<?= $cf[0][$i] ?>" selected><?= $cf[1][$i] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $cf[0][$i] ?>"><?= $cf[1][$i] ?></option>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                            <small class="form-text text-danger"><i><?= form_error('cfpakar'); ?></i></small>
                        </div>

                        <div class="footer">
                            <a href="<?= base_url('managetelepon/gejala'); ?>" class="btn btn-outline-dark">Kembali</a>
                            <button type="submit" name="tambah" class="btn btn-dark float-right">Tambah Data Gejala</button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->