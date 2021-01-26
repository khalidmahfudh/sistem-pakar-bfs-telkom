<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasitelepon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Telepon_model');
        $this->load->model('Request_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }
    public function index()
    {
        $data['title'] = "Gangguan Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();
        $data['gangguan'] = $this->Telepon_model->getAllGangguan();
        $data['gejalaGangguan'] = $this->Telepon_model->getAllGejalaCompGangguan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasitelepon/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = "Gangguan Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();
        $data['gangguanById'] = $this->Telepon_model->getGangguanById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasitelepon/detail', $data);
        $this->load->view('templates/footer');
    }

    public function diagnosa()
    {
        $data['title'] = "Gangguan Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();
        $data['gejala'] = $this->Telepon_model->getAllGejala();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasitelepon/diagnosa', $data);
        $this->load->view('templates/footer');
    }

    public function percentage()
    {
        $data['title'] = "Gangguan Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();
        $allGejalaWithGangguan = $this->Telepon_model->gejalaByGangguan2();
        $allGejala = $this->Telepon_model->getAllGejala();

        $selectedByUser = $this->input->post('selectGejala');
        $selectedByUser = explode("-", $selectedByUser);
        $selectedByUser = $selectedByUser[0];

        $root[0] = $allGejala[0]['kode_gejala'];
        $root[1] = $allGejala[0]['cf_pakar'];

        $allGejalaByGangguan = [];
        foreach ($allGejalaWithGangguan as $gangguan) {
            array_push($allGejalaByGangguan, array_chunk(array_slice($gangguan, 3), 3));
        }

        $allGejalaByGangguanWithoutRoot = [];
        for ($i = 0; $i < count($allGejalaByGangguan); $i++) {
            if ($allGejalaByGangguan[$i][0][1] == $root[0]) {
                array_push($allGejalaByGangguanWithoutRoot, array_slice($allGejalaByGangguan[$i], 1));
            } else {
                array_push($allGejalaByGangguanWithoutRoot, $allGejalaByGangguan[$i]);
            }
        }

        $lists = [];
        for ($i = 0; $i < count($allGejalaByGangguanWithoutRoot); $i++) {
            for ($j = 0; $j < count($allGejalaByGangguanWithoutRoot[$i]); $j++) {
                $lists[$i][$j] = array_slice($allGejalaByGangguanWithoutRoot[$i][$j], 1);
            }
        }

        $open = [];
        $closed = [];
        $match = "";

        array_push($open, $root);

        if ($open[0][0] == $selectedByUser) {
            $match = $open[0][0];
        } else {
            array_push($closed, array_shift($open));
            $rootChild = [];

            foreach ($lists as $list) {
                if ($list[0][1] == 1) {
                    array_push($rootChild, $list);
                }
            }
            foreach ($lists as $list) {
                if ($list[0][1] == 0.8) {
                    array_push($rootChild, $list);
                }
            }
            foreach ($lists as $list) {
                if ($list[0][1] == 0.6) {
                    array_push($rootChild, $list);
                }
            }
            foreach ($lists as $list) {
                if ($list[0][1] == 0.4) {
                    array_push($rootChild, $list);
                }
            }
            foreach ($lists as $list) {
                if ($list[0][1] == 0.2) {
                    array_push($rootChild, $list);
                }
            }
            foreach ($lists as $list) {
                if ($list[0][1] == 0) {
                    array_push($rootChild, $list);
                }
            }

            $unknownResult = true;
            foreach ($rootChild as $child) {
                if ($child[0][0] == $selectedByUser) {
                    $match = $child[0][0];
                    $unknownResult = false;
                } else {
                    if (count($child) > 1) {
                        for ($i = 0; $i < count($child); $i++) {
                            if ($child[$i][0] == $selectedByUser) {
                                $match = $child[$i][0];
                                $unknownResult = false;
                            }
                        }
                    }
                }
            }

            if ($unknownResult) {
                redirect('konsultasitelepon/unknownresult');
            }
        }

        $questions = [];
        for ($i = 0; $i < count($allGejalaWithGangguan); $i++) {
            array_chunk(array_slice($allGejalaByGangguan[$i], 3), 3);
            foreach ($allGejalaByGangguan[$i] as $gejala) {
                if ($match == $gejala[1]) {
                    array_push($questions, $allGejalaWithGangguan[$i]);
                }
            }
        }

        $data['questions'] = $questions;
        $this->session->set_userdata(['questions_' => $questions]);
        $data['checked'] = $selectedByUser;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasitelepon/percentage', $data);
        $this->load->view('templates/footer');
    }


    public function unknownresult()
    {
        $data['title'] = "Gangguan Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();
        $data['gangguan'] = $this->Telepon_model->getAllGangguan();
        $data['gejalaGangguan'] = $this->Telepon_model->getAllGejalaCompGangguan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasitelepon/unknownresult', $data);
        $this->load->view('templates/footer');
    }

    public function result()
    {
        $data['title'] = "Gangguan Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();
        $data['gangguan'] = $this->Telepon_model->getAllGangguan();
        $data['gejalaGangguan'] = $this->Telepon_model->getAllGejalaCompGangguan();

        $getData = $this->input->post();

        $questions = $this->session->userdata('questions_');



        // Memisahkan gangguan, kode gangguan dan solusi, bersisa gejala2nya
        for ($i = 0; $i < count($questions); $i++) {
            $theQuestions[$i] = array_slice($questions[$i], 3);
        }

        // Setelah dipisahkan, gejala2nya dipisah menjadi bagian2 array
        for ($i = 0; $i < count($questions); $i++) {
            $allGejala[$i] = array_chunk($theQuestions[$i], 3);
        }

        // Mengkonversi value range menjadi angka certain factor 
        $getData2 = [];
        foreach ($getData as $theData) {
            if ($theData == "1") {
                $theData = "1";
            } else {
                $theData = "0";
            }
            array_push($getData2, $theData);
        }

        // Mengkalikan CF User dengan CF Pakar
        $k = 0;
        for ($i = 0; $i < count($allGejala); $i++) {
            for ($j = 0; $j < count($allGejala[$i]); $j++) {
                $getData2[$k] =  $getData2[$k] * $allGejala[$i][$j][2];
                $k++;
            }
        }


        // Menambahkan cf user x cf pakar di masing2 gejala
        $j = 0;
        for ($i = 0; $i < count($allGejala); $i++) {
            $k = 0;
            for ($l = 0; $l < count($getData2); $l++) {
                if ($k == count($allGejala[$i])) {
                    continue;
                } else {
                    array_push($allGejala[$i][$k], $getData2[$j]);
                    $j++;
                    $k++;
                }
            }
        }

        // Memasukkan Rumus CF Combine
        $CFC = [];
        for ($i = 0; $i < count($allGejala); $i++) {

            if (count($allGejala[$i]) == 2) {
                $CFC[$i] = $allGejala[$i][0][3] + $allGejala[$i][1][3] * (1 - $allGejala[$i][0][3]);
            } elseif (count($allGejala[$i]) == 3) {
                $CFC[$i] = $allGejala[$i][0][3] + $allGejala[$i][1][3] * (1 - $allGejala[$i][0][3]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][2][3] * (1 - $CFC[$i]);
            } elseif (count($allGejala[$i]) == 4) {
                $CFC[$i] = $allGejala[$i][0][3] + $allGejala[$i][1][3] * (1 - $allGejala[$i][0][3]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][2][3] * (1 - $CFC[$i]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][3][3] * (1 - $CFC[$i]);
            } elseif (count($allGejala[$i]) == 5) {
                $CFC[$i] = $allGejala[$i][0][3] + $allGejala[$i][1][3] * (1 - $allGejala[$i][0][3]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][2][3] * (1 - $CFC[$i]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][3][3] * (1 - $CFC[$i]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][4][3] * (1 - $CFC[$i]);
            } elseif (count($allGejala[$i]) == 6) {
                $CFC[$i] = $allGejala[$i][0][3] + $allGejala[$i][1][3] * (1 - $allGejala[$i][0][3]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][2][3] * (1 - $CFC[$i]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][3][3] * (1 - $CFC[$i]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][4][3] * (1 - $CFC[$i]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][5][3] * (1 - $CFC[$i]);
            } elseif (count($allGejala[$i]) == 7) {
                $CFC[$i] = $allGejala[$i][0][3] + $allGejala[$i][1][3] * (1 - $allGejala[$i][0][3]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][2][3] * (1 - $CFC[$i]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][3][3] * (1 - $CFC[$i]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][4][3] * (1 - $CFC[$i]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][5][3] * (1 - $CFC[$i]);
                $CFC[$i] = $CFC[$i] + $allGejala[$i][6][3] * (1 - $CFC[$i]);
            } else {
                $CFC[$i] = $allGejala[$i][0][3];
            }
        }

        // Hasil CF Combine di konversi ke persen
        for ($i = 0; $i < count($CFC); $i++) {
            $CFC[$i] = $CFC[$i] * 100;
        }

        $countAllCFC = 0;


        for ($i = 0; $i < count($CFC); $i++) {
            $countAllCFC += $CFC[$i];
        }

        $data['cfc'] = $CFC;

        // CFCOMBINE(CF1,CF2)     = CF1+ CF2* (1 - CF1)

        //  CFCOMBINE (CF1,CF2)    = 0,2 + 0,32 * (1 - 0,2)
        //  = 0,2 + 0,25
        //  = 0,45 CFold

        //  CFCOMBINE (CFold,CF3) = 0,45 + 0,6 * (1 - 0,45)
        //  = 0,45 + 0,33
        //  = 0,78 CFold

        //  CFCOMBINE (CFold,CF4) = 0,78 + 0,4 * (1 - 0,78)
        //  = 0,78 + 0,08
        //  = 0,86 CFold

        //  Prosentase keyakinan = CFCOMBINE * 100 % => 0,86  x100% = 86 %

        $data['results'] = $getData;


        $data['questions'] = $questions;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasitelepon/hasildiagnosa', $data);
        $this->load->view('templates/footer');
    }

    public function request()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $data['user']['id'];

        $this->Telepon_model->requestGejala($id_user);
        if ($data['user']['role_id'] != 1) {
            $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
        } else {
            $this->session->set_flashdata('flash', 'Ditambahkan');
        }
        redirect('konsultasitelepon/diagnosa');
    }
}
