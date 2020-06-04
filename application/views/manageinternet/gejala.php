<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <nav class="title">
        
    <h1 class="h3 text-dark text-center">Daftar Gejala Pada Gangguan Layanan Internet Fiber Indihome</h1>
    </nav>

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

    <div class="row mb-3">
        <div class="col-lg-6">
            <a href="<?= base_url('manageinternet'); ?>" class="btn btn-dark" title="back"><i class="fas fa-angle-double-left"></i></a>
            <a href="<?= base_url('manageinternet/tambahgejala'); ?>" class="btn btn-dark">Tambah Data Gejala</a>
        </div>
    </div>

    <form action="" method="post">
        <div class="input-group mb-3 col-lg-5 row">
            <input type="text" class="form-control" placeholder="Search gejala" name="keyword" autocomplete="off" autofocus value="<?= set_value('keyword'); ?>">
            <div class="input-group-append">
                <button class="btn btn-dark" type="submit" name="submit" title="search">Search</button>
                <a href="<?= base_url('manageinternet/gejala'); ?>" class="btn btn-dark ml-2" type="reset" name="reset" title="reset"><i class="fas fa-sync-alt"></i></a>
            </div>
        </div>
    </form>

    <div class="overflow-auto row">


        <div class="col-lg-9">
            <table class="table table-light text-center">
                <thead>
                    <tr class="bg-dark text-light">
                        <th scope="col">NO</th>
                        <th scope="col">Kode Gejala</th>
                        <th scope="col">Nama Gejala</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;
                    ?>
                    <?php foreach ($gejala as $g) : ?>

                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td>G<?= $g['kode_gejala']; ?></td>
                            <td><?= $g['nama_gejala']; ?></td>
                            <td>
                                <div class="d-flex">
                                    
                                <a class="badge badge-warning action text-dark mr-2" href="<?= base_url(); ?>manageinternet/ubahgejala/<?= $g['id']; ?>" title="ubah data">
                                    <i class="fas fa-fw fa-edit"></i>Edit
                                </a>
                                <a class="badge badge-danger action text-dark" href="<?= base_url(); ?>manageinternet/hapusgejala/<?= $g['id']; ?>" title="hapus data" onclick="return confirm('yakin menghapus <?= $g['nama_gejala']; ?>?');">
                                    <i class="fas fa-fw fa-trash"></i>Hapus
                                </a>
                                </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    <?php if (!$gejala) : ?>
                        <tr>
                            <th colspan="4" class="text-danger"> not found!</th>
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