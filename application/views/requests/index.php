<div class="container">
    <!-- Page Heading -->
    <nav class="title">

        <h1 class="h3 text-dark text-center">All Requests</h1>
    </nav>
    <div class="row mt-3">
        <div class="col-md-12">

            <?php if ($this->session->flashdata('flash')) : ?>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Request <?= $this->session->flashdata('flash'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    Semua Requests dari Teknisi
                </div>
                <?php
                foreach ($requests as $request) :
                ?>
                    <div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item d-flex align-items-center">
                                <div class="pict mr-4">
                                    <img class="rounded" src="<?= base_url('assets/img/profile/') . $request['image']; ?>" alt="" style="height: 80px; width: 80px;">
                                </div>

                                <div>
                                    <h5 class="mb-1 font-weight-bold">Hi Pakar! Request <?= $request['request'] . " " . $request['layanan']; ?></h5>
                                    <small class="text-muted"><?= $request['name'] ?> | <?= date('d F Y, H:i:s', $request['date']); ?></small>
                                </div>

                                <div>
                                    <a href="<?= base_url('requests/accept/' . $request['id']); ?>" class="btn btn-primary ml-3" style="width: 100px" title="Terima">Terima</a>
                                    <a href="<?= base_url('requests/reject/' . $request['id']); ?>" class="btn btn-danger ml-1" style="width: 100px" title="Tolak">Tolak</a>
                                    <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#detailModal<?= $request['id']; ?>" style="width: 100px" title="Detail">Detail</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="detailModal<?= $request['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModal<?= $request['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="formModalLabel">Detail Request <?= $request['request']; ?></h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" style="background-color: #F8F9FC;">
                                    <?php if ($request['request'] == "Tambah Data Gangguan" || $request['request'] == "Hapus Data Gangguan") : ?>
                                        <div class="form-group row mt-1">
                                            <label for="kode" class="col-sm-3 col-form-label label-gangguan">Kode</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $request['kode_gangguan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gangguan</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="nama-layanan" value="<?= $request['nama_layanan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Solusi</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <textarea name="solusi" id="solusi" cols="30" rows="10" disabled><?= $request['solusi']; ?></textarea>
                                            </div>
                                        </div>

                                    <?php elseif ($request['request'] == "Ubah Data Gangguan") : ?>

                                        <?php

                                        if ($request['layanan'] == "Internet Fiber") {
                                            $theGangguan = $this->db->get_where('data_gangguan_internet', ['id' => $request['id_layanan']])->row_array();
                                        } elseif ($request['layanan'] == "Telepon Rumah") {
                                            $theGangguan = $this->db->get_where('data_gangguan_telepon', ['id' => $request['id_layanan']])->row_array();
                                        } else {
                                            $theGangguan = $this->db->get_where('data_gangguan_useetv', ['id' => $request['id_layanan']])->row_array();
                                        }

                                        ?>

                                        <h5 class="h5 text-dark text-center" style="text-decoration: underline;">Data Sebelumnya</h5>
                                        <div class="form-group row mt-1">
                                            <label for="kode" class="col-sm-3 col-form-label label-gangguan">Kode</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $theGangguan['kode_gangguan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gangguan</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="nama-layanan" value="<?= $theGangguan['nama_gangguan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Solusi</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <textarea name="solusi" id="solusi" cols="30" rows="10" disabled><?= $theGangguan['solusi_gangguan']; ?></textarea>
                                            </div>
                                        </div>
                                        <h5 class="h5 text-dark text-center" style="text-decoration: underline;">Data Sesudah</h5>

                                        <div class="form-group row mt-1">
                                            <label for="kode" class="col-sm-3 col-form-label label-gangguan">Kode</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $theGangguan['kode_gangguan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gangguan</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="nama-layanan" value="<?= $request['nama_layanan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Solusi</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <textarea name="solusi" id="solusi" cols="30" rows="10" disabled><?= $request['solusi']; ?></textarea>
                                            </div>
                                        </div>

                                    <?php elseif ($request['request'] == "Tambah Data Gejala" || $request['request'] == "Hapus Data Gejala") : ?>
                                        <div class="form-group row mt-1">
                                            <label for="kode" class="col-sm-3 col-form-label label-gangguan">Kode</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $request['kode_gejala']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gejala</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="nama-layanan" value="<?= $request['nama_layanan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">CF Pakar</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="cf-pakar" value="<?= $request['cf_pakar']; ?>" disabled>
                                            </div>
                                        </div>

                                    <?php elseif ($request['request'] == "Ubah Data Gejala") : ?>

                                        <?php

                                        if ($request['layanan'] == "Internet Fiber") {
                                            $theGejala = $this->db->get_where('data_gejala_internet', ['id' => $request['id_layanan']])->row_array();
                                        } elseif ($request['layanan'] == "Telepon Rumah") {
                                            $theGejala = $this->db->get_where('data_gejala_telepon', ['id' => $request['id_layanan']])->row_array();
                                        } else {
                                            $theGejala = $this->db->get_where('data_gejala_useetv', ['id' => $request['id_layanan']])->row_array();
                                        }
                                        ?>

                                        <h5 class="h5 text-dark text-center" style="text-decoration: underline;">Data Sebelumnya</h5>
                                        <div class="form-group row mt-1">
                                            <label for="kode" class="col-sm-3 col-form-label label-gangguan">Kode</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $theGejala['kode_gejala']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gejala</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="nama-layanan" value="<?= $theGejala['nama_gejala']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">CF Pakar</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="cf-pakar" value="<?= $theGejala['cf_pakar']; ?>" disabled>
                                            </div>
                                        </div>
                                        <h5 class="h5 text-dark text-center">Data Sesudah</h5>

                                        <div class="form-group row mt-1">
                                            <label for="kode" class="col-sm-3 col-form-label label-gangguan">Kode</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $theGejala['kode_gejala']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gejala</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="nama-layanan" value="<?= $request['nama_layanan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">CF Pakar</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="cf-pakar" value="<?= $request['cf_pakar']; ?>" disabled>
                                            </div>
                                        </div>
                                    <?php else : ?>

                                        <?php

                                        // Rules

                                        if ($request['layanan'] == "Internet Fiber") {
                                            $this->db->select('*');
                                            $this->db->from('data_gejala_internet');
                                            $this->db->join('gejala_gangguan_internet', 'data_gejala_internet.kode_gejala = gejala_gangguan_internet.kode_gejala');
                                            $this->db->where(array('gejala_gangguan_internet.kode_gangguan' => $request['kode_gangguan']));
                                            $getGejalaByGangguanBefore = $this->db->get()->result_array();

                                            $allGejala = $this->db->get('data_gejala_internet')->result_array();
                                        } elseif ($request['layanan'] == "Telepon Rumah") {
                                            $this->db->select('*');
                                            $this->db->from('data_gejala_telepon');
                                            $this->db->join('gejala_gangguan_telepon', 'data_gejala_telepon.kode_gejala = gejala_gangguan_telepon.kode_gejala');
                                            $this->db->where(array('gejala_gangguan_telepon.kode_gangguan' => $request['kode_gangguan']));
                                            $getGejalaByGangguanBefore = $this->db->get()->result_array();

                                            $allGejala = $this->db->get('data_gejala_telepon')->result_array();
                                        } else {
                                            $this->db->select('*');
                                            $this->db->from('data_gejala_useetv');
                                            $this->db->join('gejala_gangguan_useetv', 'data_gejala_useetv.kode_gejala = gejala_gangguan_useetv.kode_gejala');
                                            $this->db->where(array('gejala_gangguan_useetv.kode_gangguan' => $request['kode_gangguan']));
                                            $getGejalaByGangguanBefore = $this->db->get()->result_array();

                                            $allGejala = $this->db->get('data_gejala_useetv')->result_array();
                                        }


                                        $kodeGejala = str_split($request['kode_gejala'], 3);



                                        ?>

                                        <h5 class="h5 text-dark text-center" style="text-decoration: underline;">Data Sebelumnya</h5>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gangguan</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="nama-layanan" value="<?= $request['nama_layanan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gejala</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <ul class="list-group">
                                                    <?php foreach ($getGejalaByGangguanBefore as $ggbgb) : ?>
                                                        <li class="list-group-item"><?= $ggbgb['nama_gejala']; ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <h5 class="h5 text-dark text-center" style="text-decoration: underline;">Data Sesudahnya</h5>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gangguan</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="nama-layanan" value="<?= $request['nama_layanan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gejala</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <ul class="list-group">
                                                    <?php foreach ($allGejala as $gejala) { ?>
                                                        <?php for ($i = 0; $i < count($kodeGejala); $i++) { ?>
                                                            <?php if ($gejala['kode_gejala'] == $kodeGejala[$i]) : ?>
                                                                <li class="list-group-item"><?= $gejala['nama_gejala']; ?></li>
                                                            <?php endif; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="modal-footer bg-light text-white">
                                    <a href="<?= base_url('requests/accept/' . $request['id']); ?>" class="btn btn-primary ml-3" style="width: 100px" title="Terima">Terima</a>
                                    <a href="<?= base_url('requests/reject/' . $request['id']); ?>" class="btn btn-danger ml-1" style="width: 100px" title="Tolak">Tolak</a>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>

        </div>
    </div>

</div>



</div>

<!-- /.container-fluid -->