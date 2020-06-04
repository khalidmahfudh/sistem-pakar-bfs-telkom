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

        $data = [
            "kode_gejala" => $kode,
            "nama_gejala" => $this->input->post('namagejala', true),
        ];

        $this->db->insert('data_gejala_useetv', $data);
    }

    public function getGejalaById($id)
    {
        return $this->db->get_where('data_gejala_useetv', ['id' => $id])->row_array();
    }

    public function ubahDataGejala()
    {
        $data = [
            "nama_gejala" => $this->input->post('namagejala', true)
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

        if ( count($result) > 1 ) {
            return $result;
        } 
    }

    public function getGejalaByGangguan($kode_gejala)
    {
        $result = $this->_getGangguanByKodeGejala($kode_gejala);

        if ( count($result) > 1 ) {

            $allKodeGangguan = '';

            foreach ($result as $res) {
                $allKodeGangguan .= $res['kode_gangguan'].'-';
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

            $problems[$i++] = $result ;

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

    public function diagnosa($param)
    {
        $data['title'] = "Gangguan Useetv Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();  
        $data['gejalaByGangguan'] = $this->Useetv_model->gejalaByGangguan2();  

        $gejalaByGangguan = $data['gejalaByGangguan'];
        $firstQuestion = $data['gejalaByGangguan'][0][3];


        $i = 0;
        $j = 0;
        foreach ($gejalaByGangguan as $gbg) {   
            if ($gbg[3] == $firstQuestion) {
                $selectedQue[$i] = $gbg;
                $i++;
            } else {
                $selectedQue2[$j] = $gbg;
                $j++;
            }
        }


        if ( $param == 'first') {
            $data['kode'] = 1;
            $questions = $this->Useetv_model->getAllGejala();  
            $question[0] = $questions[0];
            $data['question'] = $question;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiuseetv/diagnosa', $data);
            $this->load->view('templates/footer');

        } else if ( $param == 'second' ){
            $data['questions'] = $selectedQue2;      

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiuseetv/diagnosa2', $data);
            $this->load->view('templates/footer');

        } else if ( $param == 'transition' ){

            $str = ($this->input->post('radio1'));
            $radio = explode("-",$str);


            if ( $radio[2] == 1) {

                $kode = $radio[0];
                $ans = $radio[1];
                $div = $radio[2];


                $data = [
                    'kode' => $kode,
                    'ans' => $ans,
                    'div' => $div
                ];
                $this->session->set_userdata($data);

                if ($ans == '1') {
                    redirect('konsultasiuseetv/diagnosa/persentase');
                } else {
                    redirect('konsultasiuseetv/diagnosa/second');
                }

            } else {

                $kode = $radio[0];
                $ans = $radio[1];
                $div = $radio[2];


                $data = [
                    'kode' => $kode,
                    'ans' => $ans,
                    'div' => $div
                ];

                $this->session->set_userdata($data);

                if ($kode == '999') {
                    redirect('konsultasiuseetv/diagnosa/unknownresult');
                } else {
                    redirect('konsultasiuseetv/diagnosa/persentase');
                }
            }

        } else if ( $param == 'persentase') {


            $kode = $this->session->userdata('kode');
            $ans = $this->session->userdata('ans');
            $div = $this->session->userdata('div');

            $data['kode'] = $kode;

            if ( $div == '1' ){
                $data['questions'] = $selectedQue;    
            } else {

                $j = 0;

                foreach ($selectedQue as $sq) {
                    for ($i=0; $i < count(array_slice($sq,3)); $i++) { 
                        if ( array_slice($sq,3)[$i] == $kode ) {
                            $selected[$j] = $sq;
                            $j++;
                        }
                    }  
                }
                
                foreach ($selectedQue2 as $sq2) {
                    for ($i=0; $i < count(array_slice($sq2,3)); $i++) { 
                        if ( array_slice($sq2,3)[$i] == $kode ) {
                            $selected[$j] = $sq2;
                            $j++;
                        }
                    }  
                }

                $data['questions'] = $selected; 

            }

            $data['allKodeGangguan'] = $this->session->userdata('allKodeGangguan');


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiuseetv/persentasediagnosa', $data);
            $this->load->view('templates/footer');



        } else if ( $param == 'result' ){

            $data['results'] = $this->input->post();


            if ( !$data['results'] ) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } 

            $kode = $this->session->userdata('kode');
            $ans = $this->session->userdata('ans');
            $div = $this->session->userdata('div');

            if ( $div == '1' ){
                $data['questions'] = $selectedQue;    
            } else {

                $j = 0;

                foreach ($selectedQue as $sq) {
                    for ($i=0; $i < count(array_slice($sq,3)); $i++) { 
                        if ( array_slice($sq,3)[$i] == $kode ) {
                            $selected[$j] = $sq;
                            $j++;
                        }
                    }  
                }
                
                foreach ($selectedQue2 as $sq2) {
                    for ($i=0; $i < count(array_slice($sq2,3)); $i++) { 
                        if ( array_slice($sq2,3)[$i] == $kode ) {
                            $selected[$j] = $sq2;
                            $j++;
                        }
                    }  
                }

                $data['questions'] = $selected; 

            }   
                // var_dump($data['questions']);die;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiuseetv/hasildiagnosa', $data);
            $this->load->view('templates/footer');


        } else if ( $param == 'unknownresult' ){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiuseetv/unknownresult', $data);
            $this->load->view('templates/footer');
        } else {

            redirect('konsultasiuseetv/index');

        }


    } 
}
