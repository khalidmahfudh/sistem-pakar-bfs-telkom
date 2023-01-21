<?php

class Internet_model extends CI_model
{
    // Gangguan
    public function getAllGangguan()
    {
        return $this->db->order_by('kode_gangguan', 'ASC')->get('data_gangguan_internet')->result_array();
    }

    public function tambahDataGangguan($id_user)
    {
        $user = $this->db->get_where('users', ['id' => $id_user])->row_array();

        $role = $user['role_id'];
        $image = $user['image'];
        $name = $user['name'];


        $kode = $this->input->post('kodegangguan');
        $kode = explode("P", $kode);
        $kode = end($kode);


        if ($role == 3) {
            $data = [
                "request" => "Tambah Data Gangguan",
                "layanan" => "Internet Fiber",
                "id_layanan" => 0,
                "kode_gejala" => 0,
                "kode_gangguan" => $kode,
                "nama_layanan" => $this->input->post('namagangguan', true),
                "solusi" => $this->input->post('solusi', true),
                "cf_pakar" => 0,
                "image" => $image,
                "name" => $name,
                "date" => time()
            ];
            $this->db->insert('user_requests', $data);
        } else {
            $data = [
                "kode_gangguan" => $kode,
                "nama_gangguan" => $this->input->post('namagangguan', true),
                "solusi_gangguan" => $this->input->post('solusi', true),
            ];

            $this->db->insert('data_gangguan_internet', $data);
        }
    }

    public function hapusDataGangguan($id, $kode)
    {
        $gangguan = $this->getGangguanById($id);

        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $role = $user['role_id'];
        $image = $user['image'];
        $name = $user['name'];

        if ($role == 3) {
            $data = [
                "request" => "Hapus Data Gangguan",
                "layanan" => "Internet Fiber",
                "id_layanan" => $id,
                "kode_gejala" => 0,
                "kode_gangguan" => $kode,
                "nama_layanan" => $gangguan['nama_gangguan'],
                "solusi" => $gangguan['solusi_gangguan'],
                "cf_pakar" => 0,
                "image" => $image,
                "name" => $name,
                "date" => time()
            ];
            $this->db->insert('user_requests', $data);
        } else {
            $this->db->delete('data_gangguan_internet', ['id' => $id]);
            $this->db->delete('gejala_gangguan_internet', ['kode_gangguan' => $kode]);
        }
    }

    public function getGangguanById($id)
    {
        return $this->db->get_where('data_gangguan_internet', ['id' => $id])->row_array();
    }

    public function ubahDataGangguan($id_user)
    {
        $user = $this->db->get_where('users', ['id' => $id_user])->row_array();

        $id_layanan = $this->input->post('id');
        $role = $user['role_id'];
        $image = $user['image'];
        $name = $user['name'];

        if ($role == 3) {
            $data = [
                "request" => "Ubah Data Gangguan",
                "layanan" => "Internet Fiber",
                "id_layanan" => $id_layanan,
                "kode_gejala" => 0,
                "kode_gangguan" => 0,
                "nama_layanan" => $this->input->post('namagangguan', true),
                "solusi" => $this->input->post('solusi', true),
                "cf_pakar" => 0,
                "image" => $image,
                "name" => $name,
                "date" => time()
            ];
            $this->db->insert('user_requests', $data);
        } else {

            $data = [
                "nama_gangguan" => $this->input->post('namagangguan', true),
                "solusi_gangguan" => $this->input->post('solusi', true)
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('data_gangguan_internet', $data);
        }
    }

    public function cariDataGangguan()
    {
        $gangguan = $this->getAllGangguan();
        $keyword = $this->input->post('keyword', true);

        if (strlen($keyword) == 4) {
            $keyword = strtoupper($keyword);
            $keyword = explode("P", $keyword);
            $keyword = end($keyword);

            foreach ($gangguan as $g) {
                if (strcmp($keyword, $g['kode_gangguan']) == 0) {
                    return $this->db->get_where('data_gangguan_internet', ['kode_gangguan' => $g['kode_gangguan']])->result_array();
                }
            }
        }

        $this->db->like('nama_gangguan', $keyword);
        $this->db->or_like('solusi_gangguan', $keyword);
        return $this->db->get('data_gangguan_internet')->result_array();
    }

    public function countAllGangguan()
    {
        return $this->db->get('data_gangguan_internet')->num_rows();
    }

    // Gejala
    public function getAllGejala()
    {
        return $this->db->get('data_gejala_internet')->result_array();
    }

    public function tambahDataGejala($id_user)
    {
        $user = $this->db->get_where('users', ['id' => $id_user])->row_array();

        $role = $user['role_id'];
        $image = $user['image'];
        $name = $user['name'];

        $kode = $this->input->post('kodegejala');
        $kode = explode("G", $kode);
        $kode = end($kode);

        $cfpakar = $this->input->post('cfpakar');

        if ($role == 3) {
            $data = [
                "request" => "Tambah Data Gejala",
                "layanan" => "Internet Fiber",
                "id_layanan" => 0,
                "kode_gejala" => $kode,
                "kode_gangguan" => 0,
                "nama_layanan" => $this->input->post('namagejala', true),
                "solusi" => "",
                "cf_pakar" => $cfpakar,
                "image" => $image,
                "name" => $name,
                "date" => time()
            ];
            $this->db->insert('user_requests', $data);
        } else {

            $data = [
                "kode_gejala" => $kode,
                "nama_gejala" => $this->input->post('namagejala', true),
                "cf_pakar" => $cfpakar,
            ];

            $this->db->insert('data_gejala_internet', $data);
        }
    }

    public function getGejalaById($id)
    {
        return $this->db->get_where('data_gejala_internet', ['id' => $id])->row_array();
    }

    public function getGejalaByKode($kode)
    {
        return $this->db->get_where('data_gejala_internet', ['kode_gejala' => $kode])->row_array();
    }

    public function ubahDataGejala($id_user)
    {

        $user = $this->db->get_where('users', ['id' => $id_user])->row_array();

        $id_layanan = $this->input->post('id');
        $role = $user['role_id'];
        $image = $user['image'];
        $name = $user['name'];

        if ($role == 3) {
            $data = [
                "request" => "Ubah Data Gejala",
                "layanan" => "Internet Fiber",
                "id_layanan" => $id_layanan,
                "kode_gejala" => 0,
                "kode_gangguan" => 0,
                "nama_layanan" => $this->input->post('namagejala', true),
                "solusi" => "",
                "cf_pakar" => $this->input->post('cfpakar', true),
                "image" => $image,
                "name" => $name,
                "date" => time()
            ];
            $this->db->insert('user_requests', $data);
        } else {

            $data = [
                "nama_gejala" => $this->input->post('namagejala', true),
                "cf_pakar" => $this->input->post('cfpakar'),
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('data_gejala_internet', $data);
        }
    }

    public function hapusDataGejala($id)
    {
        $gejala = $this->getGejalaById($id);



        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $role = $user['role_id'];
        $image = $user['image'];
        $name = $user['name'];

        if ($role == 3) {
            $data = [
                "request" => "Hapus Data Gejala",
                "layanan" => "Internet Fiber",
                "id_layanan" => $id,
                "kode_gejala" => $gejala['kode_gejala'],
                "kode_gangguan" => 0,
                "nama_layanan" => $gejala['nama_gejala'],
                "solusi" => "",
                "cf_pakar" => $gejala['cf_pakar'],
                "image" => $image,
                "name" => $name,
                "date" => time()
            ];
            $this->db->insert('user_requests', $data);
        } else {
            $this->db->delete('data_gejala_internet', ['id' => $id]);
            $this->db->delete('gejala_gangguan_internet', ['kode_gejala' => $gejala['kode_gejala']]);
        }
    }

    public function cariDataGejala()
    {
        $gejala = $this->getAllGejala();
        $keyword = $this->input->post('keyword', true);

        if (strlen($keyword) == 4) {
            $keyword = strtoupper($keyword);
            $keyword = explode("G", $keyword);
            $keyword = end($keyword);


            foreach ($gejala as $g) {
                if (strcmp($keyword, $g['kode_gejala']) == 0) {
                    return $this->db->get_where('data_gejala_internet', ['kode_gejala' => $g['kode_gejala']])->result_array();
                }
            }
        }

        $this->db->like('nama_gejala', $keyword);
        $this->db->or_like('cf_pakar', $keyword);
        return $this->db->get('data_gejala_internet')->result_array();
    }

    public function getGejalaByKodeGangguan($kode)
    {
        return $this->db->get_where('gejala_gangguan_internet', ['kode_gangguan' => $kode])->result_array();
    }


    public function getAllGejalaCompGangguan()
    {

        $this->db->select('*');
        $this->db->from('gejala_gangguan_internet');
        $this->db->join('data_gejala_internet', 'gejala_gangguan_internet.kode_gejala = data_gejala_internet.kode_gejala');
        $this->db->join('data_gangguan_internet', 'gejala_gangguan_internet.kode_gangguan = data_gangguan_internet.kode_gangguan');
        return $this->db->get()->result_array();
    }

    public function _getAllGejalaCompGangguanByKodeGangguan($kode_gangguan)
    {

        $this->db->select('*');
        $this->db->from('gejala_gangguan_internet');
        $this->db->join('data_gejala_internet', 'gejala_gangguan_internet.kode_gejala = data_gejala_internet.kode_gejala');
        $this->db->join('data_gangguan_internet', 'gejala_gangguan_internet.kode_gangguan = data_gangguan_internet.kode_gangguan');
        return $this->db->where('gejala_gangguan_internet.kode_gangguan', $kode_gangguan)->get()->result_array();
    }

    public function _getGangguanByKodeGejala($kode_gejala)
    {
        $this->db->select('*');
        $this->db->from('gejala_gangguan_internet');
        $this->db->join('data_gangguan_internet', 'data_gangguan_internet.kode_gangguan = gejala_gangguan_internet.kode_gangguan');
        $result = $this->db->where('gejala_gangguan_internet.kode_gejala', $kode_gejala)->get()->result_array();

        if (count($result) > 1) {
            return $result;
        }
    }

    public function getGejalaByGangguan($kode_gejala)
    {
        $result = $this->_getGangguanByKodeGejala($kode_gejala);

        if (count($result) > 1) {

            $allKodeGangguan = '';

            foreach ($result as $res) {
                $allKodeGangguan .= $res['kode_gangguan'] . '-';
            }
            $this->session->set_userdata($data = ['allKodeGangguan' => $allKodeGangguan]);


            $kodegangguan = $result[0]['kode_gangguan'];
        } else {
            $kodegangguan = $result[0]['kode_gangguan'];
        }

        return $this->_getAllGejalaCompGangguanByKodeGangguan($kodegangguan);
    }

    public function gejalaByGangguan()
    {
        $allGangguan = $this->getAllGangguan();

        $i = 0;

        foreach ($allGangguan as $gangguan) {

            $this->db->select('*');
            $this->db->from('gejala_gangguan_internet');
            $this->db->join('data_gejala_internet', 'gejala_gangguan_internet.kode_gejala = data_gejala_internet.kode_gejala');
            $this->db->join('data_gangguan_internet', 'gejala_gangguan_internet.kode_gangguan = data_gangguan_internet.kode_gangguan');
            $result = $this->db->where('gejala_gangguan_internet.kode_gangguan', $gangguan['kode_gangguan'])->get()->result_array();

            $problems[$i++] = $result;
        }

        return $problems;
    }

    public function gejalaByGangguan2()
    {
        $problems =  $this->gejalaByGangguan();

        $n = 0;
        foreach ($problems as $problem) {
            if ($problem == null) {
                unset($problems[$n]);
            }
            $n++;
        }

        $i = 0;
        foreach ($problems as $pro) {

            $theGangguan[$i][0] = $pro[0]['nama_gangguan'];
            $theGangguan[$i][1] = $pro[0]['kode_gangguan'];
            $theGangguan[$i][2] = $pro[0]['solusi_gangguan'];

            $j = 3;
            foreach ($pro as $p) {
                $theGangguan[$i][$j] = $p['nama_gejala'];
                $theGangguan[$i][++$j] = $p['kode_gejala'];
                $theGangguan[$i][++$j] = $p['cf_pakar'];

                $j++;
            }

            $i++;
        }


        return $theGangguan;
    }
    public function requestGejala($id_user)
    {
        $user = $this->db->get_where('users', ['id' => $id_user])->row_array();

        $role = $user['role_id'];
        $image = $user['image'];
        $name = $user['name'];

        $kode = $this->input->post('kodegejala');

        if ($role != 1) {
            $data = [
                "request" => "Tambah Data Gejala",
                "layanan" => "Internet Fiber",
                "id_layanan" => 0,
                "kode_gejala" => $kode,
                "kode_gangguan" => 0,
                "nama_layanan" => $this->input->post('namagejala', true),
                "solusi" => "",
                "cf_pakar" => 0,
                "image" => $image,
                "name" => $name,
                "date" => time()
            ];
            $this->db->insert('user_requests', $data);
        } else {

            $data = [
                "kode_gejala" => $kode,
                "nama_gejala" => $this->input->post('namagejala', true),
                "cf_pakar" => 0,
            ];

            $this->db->insert('data_gejala_internet', $data);
        }
    }
}
