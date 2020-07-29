<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasitelepon extends CI_Controller
{
    var $allSymptomsPerPart = [];
    var $roots = [];
    var $root = 0;
    var $emptyArray = [];

    // Deklarasi array open dan closed
    var $open = [];
    var $closed = [];

    public function __construct()
    {
        parent::__construct();
        is_logged_in();


        $this->load->model('Telepon_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        // $this->session->unset_userdata('theQuestionsWithRoot_');
        // $this->session->unset_userdata('theQuestionsWithoutRoot_');
        // $this->session->unset_userdata('roots_');
        // $this->session->unset_userdata('symptomCode_');
        // $this->session->unset_userdata('isYes_');
        // $this->session->unset_userdata('fromRoot_');
        // $this->session->unset_userdata('number_');
        // $this->session->unset_userdata('questions_');
        // $this->session->unset_userdata('open_');
        // $this->session->unset_userdata('closed_');
        // $this->session->unset_userdata('root_');
    }
    public function index()
    {
        $data['title'] = "Gangguan Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Telepon_model->getAllGangguan();
        $data['gejalaGangguan'] = $this->Telepon_model->getAllGejalaCompGangguan();

        $this->session->unset_userdata('closed_');
        $this->session->unset_userdata('open_');
        $this->session->unset_userdata('root_');
        $this->session->unset_userdata('temporary_roots_');
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
        $data['gangguanById'] = $this->Telepon_model->getGangguanById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasitelepon/detail', $data);
        $this->load->view('templates/footer');
    }

    public function questions($number = 1)
    {
        $this->session->unset_userdata('percentage_');
        $data['title'] = "Gangguan Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejalaByGangguan'] = $this->Telepon_model->gejalaByGangguan2();

        if ($number == 0) {
            $number = 1;
        }

        /*
    |-------------------------------------------------------------------------------------------------
    | $servicesInterruptionAndSymptoms - $theRoot - $theQuestionsForPageOne - $theQuestionsForPageTwo
    |-------------------------------------------------------------------------------------------------
    |
    | $servicesInterruptionAndSymptoms = Variabel ini menampung seluruh gangguan yang ada,
    | yang tiap gangguannya terdiri dari nama_gangguan[0], kode_gangguan[1], solusi_gangguan[2], 
    | nama_gejalanya[3], kode_gejalanya[4] dst.
    |
    | $theRoot = Variabel ini berisi nama gejala awal (string), yang menjadi root pertanyaan di halaman pertama .
    |
    | $theQuestionsWithRoot = Variabel ini berisi gangguan $servicesInterruptionAndSymptoms,
    | yang di pecah, dan diambil bagian gangguan yang memiliki gangguan $theRoot
    |
    | $theQuestionsWithoutRoot = Variabel ini merupakan sisanya dari pemecahan $servicesInterruptionAndSymptoms,
    | yang berisi sisanya yaitu gangguan tanpa memiliki $theRoot untuk ditampilakn pada halaman sesudahnya
    | jika user menjawab tidak pada $theRoot
    |
    */

        $servicesInterruptionAndSymptoms = $data['gejalaByGangguan'];
        $theRoot = $data['gejalaByGangguan'][0][3];


        $i = 0;
        $j = 0;
        foreach ($servicesInterruptionAndSymptoms as $interruption) {
            if ($interruption[3] == $theRoot) {
                $theQuestionsWithRoot[$i] = $interruption;
                $i++;
            } else {
                $theQuestionsWithoutRoot[$j] = $interruption;
                $j++;
            }
        }

        $data2 = [
            'theQuestionsWithRoot_' => $theQuestionsWithRoot,
            'theQuestionsWithoutRoot_' => $theQuestionsWithoutRoot
        ];
        $this->session->set_userdata($data2);

        for ($i = 0; $i < count($servicesInterruptionAndSymptoms); $i++) {
            $theQuestions[$i] = array_slice($servicesInterruptionAndSymptoms[$i], 3);
        }

        for ($i = 0; $i < count($servicesInterruptionAndSymptoms); $i++) {
            $questions[$i] = array_chunk($theQuestions[$i], 2);

            if ($questions[$i][0][0] === $theRoot) {
                if (count($questions[$i]) > 1) {
                    array_push($this->allSymptomsPerPart, array_slice($questions[$i], 1));
                } else {
                    continue;
                }
                continue;
            } else {
                array_push($this->allSymptomsPerPart, $questions[$i]);
            }
        }

        for ($i = 0; $i < count($this->allSymptomsPerPart); $i++) {
            $this->roots[$i] = $this->allSymptomsPerPart[$i];
        }

        if ($this->session->userdata('number_')) {
            $data['number'] = $this->session->userdata('number_');
            $number = $this->session->userdata('number_');
        } else {
            $data['number'] = $number;
        }

        if ($this->session->userdata('root_')) {
            $data['root'] = $this->session->userdata('root_');
        } else {
            $data['root'] = $this->root;
        }

        if (!$this->session->userdata('open_')) {
            // masukkan root awal ke dalam open[] sebagai pertanyan pertama
            array_push($this->open, $theQuestionsWithRoot[0][4]);
        } else {
            $this->open = $this->session->userdata('open_');
            $this->closed = $this->session->userdata('closed_');
        }


        $data1 = [
            'open_' => $this->open,
            'closed_' => $this->closed,
            'roots_' => $this->roots
        ];
        $this->session->set_userdata($data1);


        // id,nama gejala dan kode gejala untuk dikirim ke view

        $symptom = $this->Telepon_model->getGejalaByKode($this->open[0]);

        $data['question'] = $symptom;



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasitelepon/diagnosa', $data);
        $this->load->view('templates/footer');
    }

    public function transition()
    {
        $getData = $this->input->post();

        $open = $this->session->userdata('open_');
        $closed = $this->session->userdata('closed_');
        $roots = $this->session->userdata('roots_');

        $answer = $getData['radio1'];
        $theAnswer = explode(":", $answer);

        $symptomCode = $theAnswer[0];
        $isYes = $theAnswer[1];
        $fromRoot = $theAnswer[2];
        $number = $theAnswer[3];

        $data = [
            'symptomCode_' => $symptomCode,
            'isYes_' => $isYes,
            'fromRoot_' => $fromRoot,
            'number_' => $number
        ];
        $this->session->set_userdata($data);

        // jika jawaban "IYA" maka pelacakan selesai dan menuju kehalaman perhitungan persentase
        // jika jawaban "TIDAK" maka pelacakan dilanjutkan
        if ($isYes == '1') {
            $this->session->set_userdata(['number_' => "1"]);
            $this->session->set_userdata(['percentage_' => true]);
            $this->session->unset_userdata('closed_');
            $this->session->unset_userdata('open_');
            $this->session->unset_userdata('root_');
            redirect('konsultasitelepon/percentage');
        } else {

            if ($this->session->userdata('temporary_roots_') === $this->emptyArray) {
                $this->session->unset_userdata('temporary_roots_');
                $fromRoot++;
                $number++;
                array_push($closed, array_shift($open));

                if (count($open) == 0) {
                    $this->session->set_userdata(['number_' => "1"]);
                    $this->session->set_userdata(['percentage_' => true]);
                    $this->session->unset_userdata('closed_');
                    $this->session->unset_userdata('open_');
                    $this->session->unset_userdata('root_');
                    redirect('konsultasitelepon/unknownresult');
                }

                $data = [
                    'open_' => $open,
                    'closed_' => $closed,
                    'roots_' => $roots,
                    'root_' => $fromRoot,
                    'number_' => $number
                ];
                $this->session->set_userdata($data);

                redirect('konsultasitelepon/questions/' . $number);
            }

            // memindahkan open[0] ke closed[]
            array_push($closed, array_shift($open));

            // Mengisi open[] dengan seluruh child root awal
            if ($fromRoot == 0) {
                for ($i = 0; $i < count($roots); $i++) {
                    array_push($open, $roots[$i][0][1]);
                }
                $fromRoot++;
                $number++;
            } else {

                if (!$_SESSION['temporary_roots_']) {
                    // memasukkan open[0] child dari open[0] sebelumnya jika ada
                    $i = $fromRoot - 1;

                    if (count($roots[$i]) > 1) {

                        $temporary_roots = [];
                        for ($j = 1; $j < count($roots[$i]); $j++) {
                            array_push($temporary_roots, $roots[$i][$j][1]);
                        }
                        $this->session->set_userdata(['temporary_roots_' => $temporary_roots]);
                    }
                }

                if ($_SESSION['temporary_roots_']) {

                    $temporary_roots = $this->session->userdata('temporary_roots_');
                    array_unshift($open, $temporary_roots[0]);
                    array_shift($temporary_roots);

                    $_SESSION['temporary_roots_'] = $temporary_roots;
                } else {
                    $fromRoot++;
                }
                $number++;
            }

            $data = [
                'open_' => $open,
                'closed_' => $closed,
                'roots_' => $roots,
                'root_' => $fromRoot,
                'number_' => $number
            ];
            $this->session->set_userdata($data);

            if (count($open) == 0) {
                $this->session->set_userdata(['number_' => "1"]);
                $this->session->set_userdata(['percentage_' => true]);
                $this->session->unset_userdata('closed_');
                $this->session->unset_userdata('open_');
                $this->session->unset_userdata('root_');
                redirect('konsultasitelepon/unknownresult');
            }

            $this->session->set_userdata(['percentage_' => true]);
            redirect('konsultasitelepon/questions/' . $number);
        }
    }

    public function percentage()
    {
        if (!$this->session->userdata('percentage_') || !$this->session->userdata('symptomCode_')) {
            redirect('konsultasitelepon/questions/1');
        }
        $data['title'] = "Gangguan Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejalaByGangguan'] = $this->Telepon_model->gejalaByGangguan2();

        $symptomCode = $this->session->userdata('symptomCode_');
        $isYes = $this->session->userdata('isYes_');
        $fromRoot = $this->session->userdata('fromRoot_');


        $theQuestionsWithRoot = $this->session->userdata('theQuestionsWithRoot_');
        $theQuestionsWithoutRoot = $this->session->userdata('theQuestionsWithoutRoot_');


        $data['symptomCode'] = $symptomCode;

        if ($fromRoot == 0) {
            $data['questions'] = $theQuestionsWithRoot;
        } else {

            $j = 0;

            foreach ($theQuestionsWithRoot as $questionsWithRoot) {
                for ($i = 0; $i < count(array_slice($questionsWithRoot, 3)); $i++) {
                    if (array_slice($questionsWithRoot, 3)[$i] == $symptomCode) {
                        $selected[$j] = $questionsWithRoot;
                        $j++;
                    }
                }
            }

            foreach ($theQuestionsWithoutRoot as $questionWithoutRoot) {
                for ($i = 0; $i < count(array_slice($questionWithoutRoot, 3)); $i++) {
                    if (array_slice($questionWithoutRoot, 3)[$i] == $symptomCode) {
                        $selected[$j] = $questionWithoutRoot;
                        $j++;
                    }
                }
            }

            $data['questions'] = $selected;
        }

        $this->session->set_userdata(['questions_' => $data['questions']]);


        $data['allKodeGangguan'] = $this->session->userdata('allKodeGangguan');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasitelepon/persentasediagnosa', $data);
        $this->load->view('templates/footer');
    }

    public function reset()
    {
        $this->session->set_userdata(['number_' => "1"]);
        $this->session->unset_userdata('closed_');
        $this->session->unset_userdata('open_');
        $this->session->unset_userdata('root_');
        $this->session->unset_userdata('temporary_roots_');
        redirect('konsultasitelepon/questions/1');
    }

    public function unknownresult()
    {
        $data['title'] = "Gangguan Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
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
        $data['gangguan'] = $this->Telepon_model->getAllGangguan();
        $data['gejalaGangguan'] = $this->Telepon_model->getAllGejalaCompGangguan();


        $this->session->unset_userdata('percentage_');

        $getData = $this->input->post();

        $questions = $this->session->userdata('questions_');

        // Memisahkan gangguan, kode gangguan dan solusi, bersisa gejala2nya
        for ($i = 0; $i < count($questions); $i++) {
            $theQuestions[$i] = array_slice($questions[$i], 3);
        }

        // Setelah dipisahkan, gejala2nya dipisah menjadi bagian2 array
        for ($i = 0; $i < count($questions); $i++) {
            $allGejala[$i] = array_chunk($theQuestions[$i], 2);
        }

        // Menambahkan cf pakar di masing2 gejala
        for ($i = 0; $i < count($allGejala); $i++) {
            for ($j = 0; $j < count($allGejala[$i]); $j++) {
                $cf = $this->Telepon_model->getGejalaByKode($allGejala[$i][$j][1]);
                array_push($allGejala[$i][$j], $cf['cf_pakar']);
            }
        }

        // Mengkonversi value range menjadi angka certain factor 
        $getData2 = [];
        foreach ($getData as $theData) {
            if ($theData == "1") {
                $theData = "0.5";
            } elseif ($theData == "2") {
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

        if (!$data['results']) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        $theQuestionsWithRoot = $this->session->userdata('theQuestionsWithRoot_');
        $theQuestionsWithoutRoot = $this->session->userdata('theQuestionsWithoutRoot_');

        $symptomCode = $this->session->userdata('symptomCode_');
        $isYes = $this->session->userdata('isYes_');
        $fromRoot = $this->session->userdata('fromRoot_');

        if ($fromRoot == '0') {
            $data['questions'] = $theQuestionsWithRoot;
        } else {

            $j = 0;

            foreach ($theQuestionsWithRoot as $questionsWithRoot) {
                for ($i = 0; $i < count(array_slice($questionsWithRoot, 3)); $i++) {
                    if (array_slice($questionsWithRoot, 3)[$i] == $symptomCode) {
                        $selected[$j] = $questionsWithRoot;
                        $j++;
                    }
                }
            }

            foreach ($theQuestionsWithoutRoot as $questionWithoutRoot) {
                for ($i = 0; $i < count(array_slice($questionWithoutRoot, 3)); $i++) {
                    if (array_slice($questionWithoutRoot, 3)[$i] == $symptomCode) {
                        $selected[$j] = $questionWithoutRoot;
                        $j++;
                    }
                }
            }

            $data['questions'] = $selected;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasitelepon/hasildiagnosa', $data);
        $this->load->view('templates/footer');
    }
}
