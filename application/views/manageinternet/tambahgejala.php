<div class="container">
    <!-- Page Heading -->
    <nav class="title">        
    <h1 class="h3 text-dark text-center">Tambah Data Gejala Internet Fiber</h1>
    </nav>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">Form Tambah Data Gejala</div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php
                        $kode = 201;
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
                            <label for="nama">CF Pakar</label><br>
                            <input type="range" min="0" max="5" id="cfpakar" name="cfpakar" class="slider2 myRange2 mt-1" value="0">
                            <span class="value2 ml-2"></span>
                            <small class="form-text text-danger"><i><?= form_error('cfpakar'); ?></i></small>
                        </div>

                        <div class="footer">
                            <a href="<?= base_url('manageinternet/gejala'); ?>" class="btn btn-outline-dark">Kembali</a>
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