<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Gejala Gangguan Telepon Rumah</h1>
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

                        <div class="footer">
                            <button type="button" class="close mr-2 float-left" title="detail">
                                <a href="<?= base_url('managetelepon/gangguan'); ?>" style="text-decoration: none; color: black; font-size: 40px;">&#16;</a>
                            </button>
                            <button type="submit" name="tambah" class="btn btn-outline-dark float-right">Tambah Data Gejala</button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->