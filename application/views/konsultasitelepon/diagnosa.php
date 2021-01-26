<!-- Begin Page Content -->


<!-- Page Heading -->

<nav class="title">
    <h1 class="h3 mb-4 text-gray-800 text-center">Diagnosa <?= $title; ?></h1>
</nav>

<div class="container">
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Gejala <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row my-2">
        <div class="col-md" id="card-container">
            <div class="card border-info mb-3" style="height: 69vh;">
                <div class="card-body">
                    <form method="post" action="<?= base_url('konsultasitelepon/percentage'); ?>" style="margin-top: 75px;">
                        <div class="text-center">
                            <img src="<?= base_url('assets/img/logo.png'); ?>" class="img-fluid my-4" alt="Responsive image" style="width: 400px;">
                        </div>
                        <div class="form-group row mx-auto d-flex justify-content-center">
                            <select class="form-control rounded-pill col-sm-10" name="selectGejala" id="selectGejala">
                                <?php foreach ($gejala as $gej) : ?>
                                    <option value="<?= $gej['kode_gejala']; ?>-<?= $gej['cf_pakar']; ?>"><?= $gej['nama_gejala']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="btn btn-light rounded-circle ml-2">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="mt-n3 ml-5">
                            <a class="small bottom-links ml-4" href="" data-toggle="modal" data-target="#requestModal">Tidak terdapat di list gejala? lapor admin.</a>
                        </div>
                    </form>
                </div>
                <div class="moto">
                    <img src="<?= base_url('assets/img/moto.png'); ?>" class="img-fluid mt-n5" alt="moto">
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="formModalLabel">Form Request</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="background-color: #F8F9FC;">

                <form action="<?= base_url('konsultasitelepon/request'); ?>" method="post">

                    <?php foreach ($gejala as $g) {
                    } ?>
                    <input type="hidden" name="kodegejala" id="kodegejala" value="<?= $g['kode_gejala'] + 1; ?>">

                    <div class="form-group">
                        <input type="text" class="form-control" id="namagejala" name="namagejala" autocomplete="off" required placeholder="Gejala yang dialami">
                    </div>

            </div>
            <div class="modal-footer bg-light text-white">
                <button type="submit" name="tambah" class="btn btn-primary float-right">Request</button>
            </div>

            </form>
        </div>
    </div>
</div>