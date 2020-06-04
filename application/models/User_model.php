<?php

class User_model extends CI_model
{
    public function getAllUser()
    {
        return $this->db->get('users')->result_array();
    }

    public function tambahDataUser()
    {
        $kode = $this->input->post('kodegangguan');
        $kode = explode("P", $kode);
        $kode = end($kode);

        $data = [
            "kode_gangguan" => $kode,
            "nama_gangguan" => $this->input->post('namagangguan', true),
            "solusi_gangguan" => $this->input->post('solusi', true),
        ];

        $this->db->insert('users', $data);
    }

    public function hapusDataUser($id)
    {
        $this->db->delete('users', ['id' => $id]);
    }

    public function getUserById($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    // ubah data dari manageusers
    public function ubahDataUser()
    {
        $data = [
            "name" => htmlspecialchars(ucwords($this->input->post('name', true))),
            "email" => $this->input->post('email', true),
            "role_id" => $this->input->post('status'),
            "is_active" => $this->input->post('aktif')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('users', $data);
    }

    public function cariDataUser()
    {
        $keyword = $this->input->post('keyword', true);
        $keyword = strtolower($keyword);

        if (strcmp($keyword, "pakar") == 0) $keyword = 1;
        if (strcmp($keyword, "user") == 0) $keyword = 2;



        $this->db->like('name', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('role_id', $keyword);
        return $this->db->get('users')->result_array();
    }

    // ubah data dari edit profile
    public function ubahDataUser2($old_image)
    {
        $name = htmlspecialchars(ucwords($this->input->post('name', true)));
        $email = $this->input->post('email');

        // cek jika ada gambar yang diupload
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {

            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/img/profile/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {

                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('user');
            }
        }
        $this->db->set('name', $name);
        $this->db->where('email', $email);
        $this->db->update('users');
    }
}
