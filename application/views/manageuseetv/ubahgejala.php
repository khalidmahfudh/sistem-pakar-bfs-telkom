<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header bg-dark text-white">Form Ubah Data Gejala</div>
                <div class="card-body">
                    <form action="" method="post">

                        <input type="hidden" name="id" value="<?= $gejala['id']; ?>">

                        <div class="form-group">
                            <label for="nama">kode Gejala Gangguan</label>
                            <input type="text" class="form-control" id="kodegejala" name="kodegejala" autocomplete="off" value="P<?= $gejala['kode_gejala']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Gejala</label>
                            <input type="text" class="form-control" id="namagejala" name="namagejala" autocomplete="off" value="<?= $gejala['nama_gejala']; ?>">
                            <small class="form-text text-danger"><i><?= form_error('namagejala'); ?></i></small>
                        </div>

                        <div class="footer">
                            <button type="button" class="close mr-2 float-left" title="detail">
                                <a href="<?= base_url('managetelepon/gejala'); ?>" style="text-decoration: none; color: black; font-size: 40px;">&#16;</a>
                            </button>
                            <button type="submit" name="ubah" class="btn btn-outline-dark float-right">Ubah Data Gejala</button>
                        </div>

                    </form>

                </div>
            </div>



        </div>
    </div>

</div>
</div>