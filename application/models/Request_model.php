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

                //Rules
            } elseif ($request['request'] == "Edit Data Rules") {

                $gejala = str_split($request['kode_gejala'], 3);

                $this->db->delete('gejala_gangguan_telepon', ['kode_gangguan' => $request['kode_gangguan']]);

                foreach ($gejala as $g) :
                    $data = [
                        "kode_gejala" => $g,
                        "kode_gangguan" => $request['kode_gangguan']
                    ];

                    $this->db->insert('gejala_gangguan_telepon', $data);
                endforeach;

                $this->db->delete('teknisi_requests', ['id' => $id]);
            }
        }

        //Internet Fiber
        if ($request['layanan'] == "Internet Fiber") {

            // Gangguan
            if ($request['request'] == "Tambah Data Gangguan") {

                $gangguanInternet = $this->db->order_by('kode_gangguan', 'ASC')->get('data_gangguan_internet')->result_array();

                $lastkode = strval(end($gangguanInternet)['kode_gangguan'] + 1);

                $currentKode = 3;

                $kode = $lastkode;

                for ($i = 0; $i < count($gangguanInternet); $i++) {
                    if ($gangguanInternet[$i]['kode_gangguan'] != $currentKode) {
                        $kode = strval($currentKode);
                    }
                    $currentKode++;
                }


                $data = [
                    "kode_gangguan" => $kode,
                    "nama_gangguan" => $request['nama_layanan'],
                    "solusi_gangguan" => $request['solusi'],
                ];
                $this->db->insert('data_gangguan_internet', $data);
                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Ubah Data Gangguan") {
                $data = [
                    "nama_gangguan" => $request['nama_layanan'],
                    "solusi_gangguan" => $request['solusi']
                ];

                $this->db->where('id', $request['id_layanan']);
                $this->db->update('data_gangguan_internet', $data);

                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Hapus Data Gangguan") {
                $this->db->delete('data_gangguan_internet', ['id' => $request['id_layanan']]);
                $this->db->delete('gejala_gangguan_internet', ['kode_gangguan' => $request['kode_gangguan']]);

                $this->db->delete('teknisi_requests', ['id' => $id]);

                // Gejala
            } elseif ($request['request'] == "Tambah Data Gejala") {

                $data = [
                    "kode_gejala" => $request['kode_gejala'],
                    "nama_gejala" => $request['nama_layanan'],
                    "cf_pakar" => $request['cf_pakar']
                ];

                $this->db->insert('data_gejala_internet', $data);
                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Ubah Data Gejala") {
                $data = [
                    "nama_gejala" => $request['nama_layanan'],
                    "cf_pakar" => $request['cf_pakar']
                ];

                $this->db->where('id', $request['id_layanan']);
                $this->db->update('data_gejala_internet', $data);
                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Hapus Data Gejala") {

                $this->db->delete('data_gejala_internet', ['id' => $request['id_layanan']]);
                $this->db->delete('gejala_gangguan_internet', ['kode_gejala' => $request['kode_gejala']]);

                $this->db->delete('teknisi_requests', ['id' => $id]);

                //Rules
            } elseif ($request['request'] == "Edit Data Rules") {

                $gejala = str_split($request['kode_gejala'], 3);

                $this->db->delete('gejala_gangguan_internet', ['kode_gangguan' => $request['kode_gangguan']]);

                foreach ($gejala as $g) :
                    $data = [
                        "kode_gejala" => $g,
                        "kode_gangguan" => $request['kode_gangguan']
                    ];

                    $this->db->insert('gejala_gangguan_internet', $data);
                endforeach;

                $this->db->delete('teknisi_requests', ['id' => $id]);
            }
        }

        //UseeTV
        if ($request['layanan'] == "UseeTV") {

            // Gangguan
            if ($request['request'] == "Tambah Data Gangguan") {

                $gangguanUseetv = $this->db->order_by('kode_gangguan', 'ASC')->get('data_gangguan_useetv')->result_array();

                $lastkode = strval(end($gangguanUseetv)['kode_gangguan'] + 1);

                $currentKode = 301;

                $kode = $lastkode;

                for ($i = 0; $i < count($gangguanUseetv); $i++) {
                    if ($gangguanUseetv[$i]['kode_gangguan'] != $currentKode) {
                        $kode = strval($currentKode);
                    }
                    $currentKode++;
                }


                $data = [
                    "kode_gangguan" => $kode,
                    "nama_gangguan" => $request['nama_layanan'],
                    "solusi_gangguan" => $request['solusi'],
                ];
                $this->db->insert('data_gangguan_useetv', $data);
                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Ubah Data Gangguan") {
                $data = [
                    "nama_gangguan" => $request['nama_layanan'],
                    "solusi_gangguan" => $request['solusi']
                ];

                $this->db->where('id', $request['id_layanan']);
                $this->db->update('data_gangguan_useetv', $data);

                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Hapus Data Gangguan") {
                $this->db->delete('data_gangguan_useetv', ['id' => $request['id_layanan']]);
                $this->db->delete('gejala_gangguan_useetv', ['kode_gangguan' => $request['kode_gangguan']]);

                $this->db->delete('teknisi_requests', ['id' => $id]);

                // Gejala
            } elseif ($request['request'] == "Tambah Data Gejala") {

                $data = [
                    "kode_gejala" => $request['kode_gejala'],
                    "nama_gejala" => $request['nama_layanan'],
                    "cf_pakar" => $request['cf_pakar']
                ];

                $this->db->insert('data_gejala_useetv', $data);
                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Ubah Data Gejala") {
                $data = [
                    "nama_gejala" => $request['nama_layanan'],
                    "cf_pakar" => $request['cf_pakar']
                ];

                $this->db->where('id', $request['id_layanan']);
                $this->db->update('data_gejala_useetv', $data);
                $this->db->delete('teknisi_requests', ['id' => $id]);
            } elseif ($request['request'] == "Hapus Data Gejala") {

                $this->db->delete('data_gejala_useetv', ['id' => $request['id_layanan']]);
                $this->db->delete('gejala_gangguan_useetv', ['kode_gejala' => $request['kode_gejala']]);

                $this->db->delete('teknisi_requests', ['id' => $id]);

                //Rules
            } elseif ($request['request'] == "Edit Data Rules") {

                $gejala = str_split($request['kode_gejala'], 3);

                $this->db->delete('gejala_gangguan_useetv', ['kode_gangguan' => $request['kode_gangguan']]);

                foreach ($gejala as $g) :
                    $data = [
                        "kode_gejala" => $g,
                        "kode_gangguan" => $request['kode_gangguan']
                    ];

                    $this->db->insert('gejala_gangguan_useetv', $data);
                endforeach;

                $this->db->delete('teknisi_requests', ['id' => $id]);
            }
        }
    }
    public function reject($id)
    {
        $this->db->delete('teknisi_requests', ['id' => $id]);
    }
}
