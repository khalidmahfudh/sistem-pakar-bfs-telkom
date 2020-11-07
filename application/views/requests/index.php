<div class="container">
    <!-- Page Heading -->
    <nav class="title">

        <h1 class="h3 text-dark text-center">All Requests</h1>
    </nav>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Semua Requests dari Teknisi
                </div>
                <?php
                $i = 0;
                foreach ($requests as $request) :
                ?>
                    <div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item d-flex align-items-center">
                                <div class="pict mr-5">
                                    <img class="rounded" src="<?= base_url('assets/img/profile/') . $request['image']; ?>" alt="" style="height: 80px; width: 80px;">
                                </div>

                                <div>
                                    <h5 class="mb-1 font-weight-bold">Hi Pakar! Request <?= $request['request'] . " " . $request['layanan']; ?></h5>
                                    <small class="text-muted"><?= $request['name'] ?>.</small>
                                </div>

                                <div>
                                    <a href="<?= base_url('requests/accept/' . $gangguan_internet[$i]['id'] . '/' . $request['id']); ?>" class="btn btn-primary ml-5" style="width: 100px">Terima</a>
                                    <a href="<?= base_url('requests/reject/' . $gangguan_internet[$i]['id'] . '/' . $request['id']); ?>" class="btn btn-danger ml-4" style="width: 100px">Tolak</a>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php
                    $i++;
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
</div>

<!-- /.container-fluid -->