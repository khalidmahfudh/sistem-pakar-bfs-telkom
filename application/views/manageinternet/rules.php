
<?php  
// die();
?>
<!--Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <nav class="title">
        
    <h1 class="h3 text-dark text-center">RULES</h1>
    </nav>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    RULES Gangguan Internet <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <a href="<?= base_url('konsultasiinternet/detail'); ?>/<?= $this->session->userdata('id_gangguan'); ?>">List Gejala</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col-lg-6">
            <a href="<?= base_url('manageinternet'); ?>" class="btn btn-dark" title="back"><i class="fas fa-angle-double-left"> kembali</i></a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Filter Data
                </div>
                <div class="card-body">
                    <form action="" method="post" class="row">
                        <h5 class="card-title col-lg-3 mt-2 mr-n3">Nama Gangguan : </h5>
                        <div class="form-group col-lg-7">
                            <select class="form-control" id="gangguan" name="gangguan">
                                <option disabled selected hidden>Pilih Gangguan</option>
                                <?php foreach ($gangguan as $g) :  ?>
                                    <option>
                                        P<?= $g['kode_gangguan']; ?> | <?= $g['nama_gangguan']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-dark col-lg-2 form-control ml-1 myButton" role="button" type="submit" name="submit" value="submit1" title="search">Tampilkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    $action = $this->input->post('submit');


    $ct = $this->input->post('gangguan');
    $kode = $this->input->post('gangguan');


    $kode = explode(" ", $kode);
    $kode = reset($kode);
    $kode = explode("P", $kode);
    $kode = end($kode);


    foreach ($gangguan as $g) {
        if ($g['kode_gangguan'] == $kode) {
            $this->session->set_userdata(['id_gangguan' => $g['id']]);
        }
    }


    $this->db->select('*');
    $this->db->from('data_gejala_internet');
    $this->db->join('gejala_gangguan_internet', 'data_gejala_internet.kode_gejala = gejala_gangguan_internet.kode_gejala');
    $this->db->where(array('gejala_gangguan_internet.kode_gangguan' => $kode));
    $getGejalaByGangguan = $this->db->get()->result_array();
    
    ?>



    <div class=" row mb-3">
        <div class="col-lg-9">
            <div class="card">

                <div class="card-header bg-dark text-white">
                    <?php if ($ct) : ?>
                        Gejala Gangguan [ <?= $ct; ?> ]
                    <?php else : ?>
                        Gejala Gangguan Internet
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php if ($this->input->post('submit') && $kode) : ?>

                        <form action="" method="post">

                            <?php if (!$getGejalaByGangguan) :
                                    $kodeGejala[1] = 9999;
                                else :
                                    $i = 1;
                                    foreach ($getGejalaByGangguan as $ggbg) :
                                        $kodeGejala[$i++] = ($ggbg['kode_gejala']);
                                    endforeach;
                                endif;
                                ?>

                            <!-- disini digunakan hidden input agar bisa mengirim kode_gangguan dari form1 -->
                            <input type="hidden" name="kode_gangguan" value="<?= $kode; ?>">

                            <a href="<?= base_url('manageinternet/tambahgejala');?>">Tambahkan gejala jika gejala dibawah tidak ada yang sesuai</a>

                            <?php foreach ($gejala as $g) :

                                    if (array_search($g['kode_gejala'], $kodeGejala)) : ?>

                                    <div class="form-check mb-2">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="G<?= $g['kode_gejala']; ?>" value="<?= $g['kode_gejala']; ?>" checked>
                                            G<?= $g['kode_gejala']; ?> | <?= $g['nama_gejala']; ?>
                                        </label>
                                    </div>
                                <?php else : ?>
                                    <div class="form-check mb-2">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="G<?= $g['kode_gejala']; ?>" value="<?= $g['kode_gejala']; ?>">
                                            G<?= $g['kode_gejala']; ?> | <?= $g['nama_gejala']; ?>
                                        </label>
                                    </div>
                                <?php endif; ?>


                            <?php endforeach; ?>

                            <button class="btn btn-dark col-lg-2 form-control ml-1 align-self-end" role="button" type="submit" name="submit2" value="submit2" title="submit">Save</button>

                        </form>

                    <?php else : ?>
                        <p class="font-italic text-danger">Pilih Gangguan Terlebih dahulu!</p>
                    <?php endif; ?>


                    <?php if (isset($_POST['submit2'])) :
                        $this->db->delete('gejala_gangguan_internet', ['kode_gangguan' => $_POST['kode_gangguan']]);


                        foreach ($gejala as $g) : ?>

                            <?php if (isset($_POST['G' . $g['kode_gejala']])) : ?>

                            <?php $codeg = $_POST['G' . $g['kode_gejala']];
                                        $codeg = explode("G", $codeg);
                                        $codeg = end($codeg);

                                        $data = [
                                            "kode_gejala" => $codeg,
                                            "kode_gangguan" => $_POST['kode_gangguan']
                                        ];

                                        $this->db->insert('gejala_gangguan_internet', $data);

                                    endif; ?>

                        <?php endforeach; ?>

                        <?php $this->session->set_flashdata('flash', 'Diperbarui');
                            redirect('manageinternet/rules');
                            ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- public function tambahDataGangguan()