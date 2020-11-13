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
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $request['nama_layanan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Solusi</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $request['solusi']; ?>" disabled>
                                            </div>
                                        </div>

                                    <?php elseif ($request['request'] == "Ubah Data Gangguan") : ?>

                                        <?php
                                        $theGangguan = $this->db->get_where('data_gangguan_telepon', ['id' => $request['id_layanan']])->row_array();
                                        ?>

                                        <h5 class="h5 text-dark text-center">Data Sebelumnya</h5>
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
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $theGangguan['nama_gangguan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Solusi</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $theGangguan['solusi_gangguan']; ?>" disabled>
                                            </div>
                                        </div>
                                        <h5 class="h5 text-dark text-center">Data Sesudah</h5>

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
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $request['nama_layanan']; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Solusi</label>
                                            <p class="mt-2 font-weight-bold equal">:</p>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="<?= $request['solusi']; ?>" disabled>
                                            </div>
                                        </div>

                                    <?php else : ?>
                                        <?= $request['request']; ?>
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