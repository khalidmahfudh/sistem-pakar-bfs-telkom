<!-- Begin Page Content -->

<!-- Page Heading -->
<nav class="title">
    
<h1 class="h3 mb-4 text-gray-800 text-center">Konsultasi <?= $title; ?></h1>
</nav>


<?php $data = array(
    'class'        => 'form-control-plaintext text-gray-900 input-gangguan bg-light rounded px-2 py-2',
    'name'        => 'solusi',
    'id'          => 'labelSolusi',
    'value'       => $gangguanById['solusi_gangguan'],
    'rows'        => '4',
    'disabled' => 'disabled',
);

$this->db->select('*');
$this->db->from('gejala_gangguan_useetv');
$this->db->join('data_gejala_useetv', 'data_gejala_useetv.kode_gejala = gejala_gangguan_useetv.kode_gejala');
$this->db->where(array('gejala_gangguan_useetv.kode_gangguan' => $gangguanById['kode_gangguan']));
$getGejalaByGangguan = $this->db->get()->result_array();


?>

<div class="container bg-div pt-5 pb-3" style="margin-top:30px">
    <div class="mb-5">
        <div class="col d-flex justify-content-center">
            <div class="row text-gray-900">

                <div class="col-sm">
                    <div class="card border-dark mb-4 btncont" style="background-color: #F8B195;">
                        <img class="img-gangguan" src="<?= base_url('assets/img/telepon.jpg') ?>" alt="useetv">
                        <div class="card-header bg-danger text-dark-900 text-center pt-3">
                            <h4>
                                Gangguan <?= $gangguanById['nama_gangguan']; ?>
                            </h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group row mt-1">
                                <label for="kode" class="col-sm-3 col-form-label label-gangguan">Kode</label>
                                <p class="mt-2 font-weight-bold equal">:</p>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext text-gray-900 input-gangguan bg-light px-2 py-2 rounded" id="kode" value="P<?= $gangguanById['kode_gangguan']; ?>" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Gejala</label>
                                <p class="mt-2 font-weight-bold equal">:</p>
                                <div class="col-sm-8">
                                    <ul class="list-group">
                                        <?php foreach ($getGejalaByGangguan as $ggbg) : ?>
                                            <li class="list-group-item"><?= $ggbg['nama_gejala']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="labelSolusi" class="col-sm-3 col-form-label label-gangguan">Solusi</label>
                                <p class="mt-2 font-weight-bold equal">:</p>
                                <div class="col-sm-8">
                                    <?= form_textarea($data); ?>
                                </div>
                            </div>
                            <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i>&nbspKembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

</div>
<!-- End of Main Content