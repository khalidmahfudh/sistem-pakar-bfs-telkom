<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <nav class="title">
        

    <h1 class="h3 text-dark text-center">Daftar User Sistem Pakar</h1>
    </nav>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data User <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <div class="row mb-3">
        <div class="col-lg-6">
            <a href="<?= base_url('manageusers/tambah'); ?>" class="btn btn-dark">Tambah Data User</a>
        </div>
    </div>

    <form action="" method="post">
        <div class="input-group mb-3 col-lg-5 row">
            <input type="text" class="form-control" placeholder="Search User" name="keyword" autocomplete="off" autofocus value="<?= set_value('keyword'); ?>">
            <div class="input-group-append">
                <button class="btn btn-dark" type="submit" name="submit">Search</button>
                <a href="" class="btn btn-dark ml-2" type="reset" name="reset" title="reset"><i class="fas fa-sync-alt"></i></a>
            </div>
        </div>
    </form>

    <div class="overflow-auto row">
        <table class="table table-light text-center">
            <thead>
                <tr class="bg-dark text-light">
                    <th scope="col">NO</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aktif</th>
                    <th scope="col">Bergabung</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = 1;
                ?>
                <?php foreach ($all_user as $au) : ?>

                    <tr>
                        <th scope="row"><?= $id++; ?></th>
                        <td><?= $au['name']; ?></td>
                        <td><?= $au['email']; ?></td>
                        <td>
                            <?php
                                if ($au['role_id'] == 1) {
                                    echo 'Pakar';
                                } else {
                                    echo 'User';
                                }
                                ?>
                        </td>
                        <td>
                            <?php
                                if ($au['is_active'] == 1) {
                                    echo 'Aktif';
                                } else {
                                    echo 'Tidak Aktif';
                                }
                                ?>
                        </td>
                        <td>
                            <?= date('d F Y', $au['date_created']); ?>
                        </td>
                        <td class="d-flex">
                            <a class="badge badge-warning action text-dark mr-2" href="<?= base_url('manageusers/ubah/' . $au['id']); ?>" title="edit">
                                <i class="fas fa-fw fa-edit"></i>Edit
                            </a>
                            <a class="badge badge-danger action text-dark" href="<?= base_url('manageusers/hapus/' . $au['id']); ?>" title="delete" onclick="return confirm('yakin menghapus <?= $au['name']; ?>?');">
                                <i class="fas fa-fw fa-trash"></i>Hapus
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                <?php if (!$all_user) : ?>
                    <tr>
                        <th colspan="7" class="text-danger"> not found!</th>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->