<?php

class Request_model extends CI_model
{
    public function getAllData()
    {
        return $this->db->get('teknisi_requests')->result_array();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('teknisi_requests', ['id' => $id])->row_array();
    }

    public function accept($id)
    {
        $request = $this->getDataById($id);

        if ($request['layanan'] == "Telepon Rumah") {

            // Gangguan
            if ($request['request'] == "Tambah Data Gangguan") {

                $gangguanTelepon = $this->db->order_by('kode_gangguan', 'ASC')->get('data_gangguan_telepon')->result_array();

                $lastkode = strval(end($gangguanTelepon)['kode_gangguan'] + 1);

                $currentKode = 101;

                $kode = $lastkode;

                for ($i = 0; $i < count($gangguanTelepon); $i++) {
                    if ($gangguanTelepon[$i]['kode_gangguan'] != $currentKode) {
                        $kode = strval($currentKode);
                    }
                    $currentKode++;
                }


                $data = [
                    "kode_gangguan" => $kode,
                    "nama_gangguan" => $request['nama_layanan'],
                    "solusi_gangguan" => $request['solusi'],
                ];
                $this->db->insert('data_gangguan_telepon', $data);

                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Ubah Data Gangguan") {
                $data = [
                    "nama_gangguan" => $request['nama_layanan'],
                    "solusi_gangguan" => $request['solusi']
                ];

                $this->db->where('id', $request['id_layanan']);
                $this->db->update('data_gangguan_telepon', $data);

                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Hapus Data Gangguan") {
                $this->db->delete('data_gangguan_telepon', ['id' => $request['id_layanan']]);
                $this->db->delete('gejala_gangguan_telepon', ['kode_gangguan' => $request['kode_gangguan']]);

                $this->db->delete('teknisi_requests', ['id' => $id]);

                // Gejala
            } elseif ($request['request'] == "Tambah Data Gejala") {

                $data = [
                    "kode_gejala" => $request['kode_gejala'],
                    "nama_gejala" => $request['nama_layanan'],
                    "cf_pakar" => $request['cf_pakar']
                ];

                $this->db->insert('data_gejala_telepon', $data);
                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Ubah Data Gejala") {
                $data = [
                    "nama_gejala" => $request['nama_layanan'],
                    "cf_pakar" => $request['cf_pakar']
                ];

                $this->db->where('id', $request['id_layanan']);
                $this->db->update('data_gejala_telepon', $data);
                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Hapus Data Gejala") {

                $this->db->delete('data_gejala_telepon', ['id' => $request['id_layanan']]);
                $this->db->delete('gejala_gangguan_telepon', ['kode_gejala' => $request['kode_gejala']]);

                $this->db->delete('teknisi_requests', ['id' => $id]);
            }
        }
    }
    public function reject($id)
    {
        $this->db->delete('teknisi_requests', ['id' => $id]);
    }
}
