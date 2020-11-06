<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <nav class="title">

        <h1 class="h3 text-dark text-center">Daftar Gangguan Pada Gangguan Layanan Internet Fiber Indihome</h1>
    </nav>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Gangguan <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col-lg-6">
            <a href="<?= base_url('manageinternet'); ?>" class="btn btn-dark" title="back"><i class="fas fa-angle-double-left"></i></a>
            <a href="<?= base_url('manageinternet/tambahgangguan'); ?>" class="btn btn-dark">Tambah Data Gangguan</a>
        </div>
    </div>

    <form action="" method="post">
        <div class="input-group mb-3 col-lg-5 row">
            <input type="text" class="form-control" placeholder="Search gangguan" name="keyword" autocomplete="off" autofocus value="<?= set_value('keyword'); ?>">
            <div class="input-group-append">
                <button class="btn btn-dark" type="submit" name="submit">Search</button>
                <a href="" class="btn btn-dark ml-2" type="reset" name="reset" title="reset"><i class="fas fa-sync-alt"></i></a>
            </div>
        </div>
    </form>

    <div class="overflow-auto row">


        <div class="col-lg">
            <table class="table table-light text-center">
                <thead>
                    <tr class="bg-dark text-light">
                        <th scope="col">NO</th>
                        <th scope="col">Kode Gangguan</th>
                        <th scope="col">Nama Gangguan</th>
                        <th scope="col">Solusi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;
                    ?>
                    <?php foreach ($gangguan as $g) : ?>


                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td>P<?= $g['kode_gangguan']; ?></td>
                            <td><?= $g['nama_gangguan']; ?></td>
                            <td><?= $g['solusi_gangguan']; ?></td>
                            <td>
                                <div class="d-flex">

                                    <a class="badge badge-warning action text-dark mr-2" href="<?= base_url(); ?>manageinternet/ubahgangguan/<?= $g['id']; ?>" title="ubah data">
                                        <i class="fas fa-fw fa-edit"></i>Ubah
                                    </a>
                                    <a class="badge badge-danger action text-light" href="<?= base_url(); ?>manageinternet/hapusgangguan/<?= $g['id']; ?>/<?= $g['kode_gangguan']; ?>" title="hapus data" onclick="return confirm('yakin menghapus <?= $g['nama_gangguan']; ?>?');">
                                        <i class="fas fa-fw fa-trash"></i>Hapus
                                    </a>

                                </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    <?php if (!$gangguan) : ?>
                        <tr>
                            <th colspan="5" class="text-danger"> not found!</th>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>


        </div>

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->