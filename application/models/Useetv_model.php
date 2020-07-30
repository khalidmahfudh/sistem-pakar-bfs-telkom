<?php

class Useetv_model extends CI_model
{
    // Gangguan
    public function getAllGangguan()
    {
        return $this->db->get('data_gangguan_useetv')->result_array();
    }

    public function tambahDataGangguan()
    {
        $kode = $this->input->post('kodegangguan');
        $kode = explode("P", $kode);
        $kode = end($kode);

        $data = [
            "kode_gangguan" => $kode,
            "nama_gangguan" => $this->input->post('namagangguan', true),
            "solusi_gangguan" => $this->input->post('solusi', true),
        ];

        $this->db->insert('data_gangguan_useetv', $data);
    }

    public function hapusDataGangguan($id, $kode)
    {
        $this->db->delete('data_gangguan_useetv', ['id' => $id]);
        $this->db->delete('gejala_gangguan_useetv', ['kode_gangguan' => $kode]);
    }

    public function getGangguanById($id)
    {
        return $this->db->get_where('data_gangguan_useetv', ['id' => $id])->row_array();
    }

    public function ubahDataGangguan()
    {
        $data = [
            "nama_gangguan" => $this->input->post('namagangguan', true),
            "solusi_gangguan" => $this->input->post('solusi', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('data_gangguan_useetv', $data);
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
                    return $this->db->get_where('data_gangguan_useetv', ['kode_gangguan' => $g['kode_gangguan']])->result_array();
                }
            }
        }

        $this->db->like('nama_gangguan', $keyword);
        $this->db->or_like('solusi_gangguan', $keyword);
        return $this->db->get('data_gangguan_useetv')->result_array();
    }

    public function countAllGangguan()
    {
        return $this->db->get('data_gangguan_useetv')->num_rows();
    }

    // GEjala
    public function getAllGejala()
    {
        return $this->db->get('data_gejala_useetv')->result_array();
    }

    public function tambahDataGejala()
    {
        $kode = $this->input->post('kodegejala');
        $kode = explode("G", $kode);
        $kode = end($kode);

        $cfpakar = $this->input->post('cfpakar');
        $cfpakar_value = 0;

        if ($cfpakar == 0) {
            $cfpakar_value = 0;
        } elseif ($cfpakar == 1) {
            $cfpakar_value = 0.2;
        } elseif ($cfpakar == 2) {
            $cfpakar_value = 0.4;
        } elseif ($cfpakar == 3) {
            $cfpakar_value = 0.6;
        } elseif ($cfpakar == 4) {
            $cfpakar_value = 0.8;
        } else {
            $cfpakar_value = 1;
        }

        $data = [
            "kode_gejala" => $kode,
            "nama_gejala" => $this->input->post('namagejala', true),
            "cf_pakar" => $cfpakar_value,
        ];

        $this->db->insert('data_gejala_useetv', $data);
    }

    public function getGejalaById($id)
    {
        return $this->db->get_where('data_gejala_useetv', ['id' => $id])->row_array();
    }

    public function getGejalaByKode($kode)
    {
        return $this->db->get_where('data_gejala_useetv', ['kode_gejala' => $kode])->row_array();
    }

    public function ubahDataGejala()
    {
        $data = [
            "nama_gejala" => $this->input->post('namagejala', true),
            "cf_pakar" => $this->input->post('cfpakar'),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('data_gejala_useetv', $data);
    }

    public function hapusDataGejala($id)
    {
        $this->db->delete('data_gejala_useetv', ['id' => $id]);
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
                    return $this->db->get_where('data_gejala_useetv', ['kode_gejala' => $g['kode_gejala']])->result_array();
                }
            }
        }

        $this->db->like('nama_gejala', $keyword);
        $this->db->or_like('cf_pakar', $keyword);
        return $this->db->get('data_gejala_useetv')->result_array();
    }

    public function getGejalaByKodeGangguan($kode)
    {
        return $this->db->get_where('gejala_gangguan_useetv', ['kode_gangguan' => $kode])->result_array();
    }


    public function getAllGejalaCompGangguan()
    {

        $this->db->select('*');
        $this->db->from('gejala_gangguan_useetv');
        $this->db->join('data_gejala_useetv', 'gejala_gangguan_useetv.kode_gejala = data_gejala_useetv.kode_gejala');
        $this->db->join('data_gangguan_useetv', 'gejala_gangguan_useetv.kode_gangguan = data_gangguan_useetv.kode_gangguan');
        return $this->db->get()->result_array();
    }

    public function _getAllGejalaCompGangguanByKodeGangguan($kode_gangguan)
    {

        $this->db->select('*');
        $this->db->from('gejala_gangguan_useetv');
        $this->db->join('data_gejala_useetv', 'gejala_gangguan_useetv.kode_gejala = data_gejala_useetv.kode_gejala');
        $this->db->join('data_gangguan_useetv', 'gejala_gangguan_useetv.kode_gangguan = data_gangguan_useetv.kode_gangguan');
        return $this->db->where('gejala_gangguan_useetv.kode_gangguan', $kode_gangguan)->get()->result_array();
    }

    public function _getGangguanByKodeGejala($kode_gejala)
    {
        $this->db->select('*');
        $this->db->from('gejala_gangguan_useetv');
        $this->db->join('data_gangguan_useetv', 'data_gangguan_useetv.kode_gangguan = gejala_gangguan_useetv.kode_gangguan');
        $result = $this->db->where('gejala_gangguan_useetv.kode_gejala', $kode_gejala)->get()->result_array();

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
            $this->db->from('gejala_gangguan_useetv');
            $this->db->join('data_gejala_useetv', 'gejala_gangguan_useetv.kode_gejala = data_gejala_useetv.kode_gejala');
            $this->db->join('data_gangguan_useetv', 'gejala_gangguan_useetv.kode_gangguan = data_gangguan_useetv.kode_gangguan');
            $result = $this->db->where('gejala_gangguan_useetv.kode_gangguan', $gangguan['kode_gangguan'])->get()->result_array();

            $problems[$i++] = $result;
        }

        return $problems;
    }

    public function gejalaByGangguan2()
    {
        $problems =  $this->gejalaByGangguan();

        $i = 0;
        foreach ($problems as $pro) {

            $theGangguan[$i][0] = $pro[0]['nama_gangguan'];
            $theGangguan[$i][1] = $pro[0]['kode_gangguan'];
            $theGangguan[$i][2] = $pro[0]['solusi_gangguan'];

            $j = 3;
            foreach ($pro as $p) {
                $theGangguan[$i][$j] = $p['nama_gejala'];
                $theGangguan[$i][++$j] = $p['kode_gejala'];
                $j++;
            }

            $i++;
        }

        return $theGangguan;
    }
}
