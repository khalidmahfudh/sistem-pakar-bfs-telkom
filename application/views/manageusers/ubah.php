<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="h3 text-dark text-center">Form Ubah Data User</div>
                <div class="card-body">

                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $single_user['id']; ?>">

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="<?= $single_user['name']; ?>">
                            <small class="-text text-danger"><i><?= form_error('name'); ?></i></small>
                        </div>

                        <div class="form-group">
                            <label for="emailuser">Email</label>
                            <input type="text" class="form-control" id="email" name="email" autocomplete="off" value="<?= $single_user['email']; ?>">
                            <small class="-text text-danger"><i><?= form_error('email'); ?></i></small>
                        </div>

                        <div class="form-group">
                            <label>Status</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="radioPakar" value="1" <?php if ($single_user['role_id'] == "1") echo "checked"; ?>>
                                <label class="form-check-label" for="radioPakar">
                                    Pakar
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="radioUser" value="2" <?php if ($single_user['role_id'] == "2") echo "checked"; ?>>
                                <label class="form-check-label" for="radioUser">
                                    User
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Aktif</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="aktif" id="radioYa" value="1" <?php if ($single_user['is_active'] == "1") echo "checked"; ?>>
                                <label class="form-check-label" for="radioYa">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="aktif" id="radioTidak" value="0" <?php if ($single_user['is_active'] == "0") echo "checked"; ?>>
                                <label class="form-check-label" for="radioTidak">
                                    Tidak
                                </label>
                            </div>
                        </div>

                        <div class="footer">
                            <button type="button" class="close mr-2 float-left" title="detail">
                                <a href="<?= base_url('manageusers'); ?>" style="text-decoration: none; color: black; font-size: 40px;">&#16;</a>
                            </button>
                            <button type="submit" name="ubah" class="btn btn-outline-dark float-right">Ubah Data User</button>
                        </div>

                    </form>
                    <?php if (isset($_POST['status'])) {
                        $data = [
                            'status' => $this->input->post('status'),
                            'aktif' => $this->input->post('aktif')
                        ];
                        $this->session->set_userdata($data);
                    }
                    ?>
                </div>
            </div>



        </div>
    </div>

</div>
</div>