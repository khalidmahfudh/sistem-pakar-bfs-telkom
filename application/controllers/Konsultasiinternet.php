<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasiinternet extends CI_Controller
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


        $this->load->model('Internet_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }
    public function index()
    {
        $data['title'] = "Gangguan Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Internet_model->getAllGangguan();
        $data['gejalaGangguan'] = $this->Internet_model->getAllGejalaCompGangguan();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasiinternet/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = "Gangguan Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguanById'] = $this->Internet_model->getGangguanById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasiinternet/detail', $data);
        $this->load->view('templates/footer');
    }

    public function questions($number = 1)
    {
        $data['title'] = "Gangguan Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejalaByGangguan'] = $this->Internet_model->gejalaByGangguan2();

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
    | $theQuestionsForPageOne = Variabel ini berisi gangguan $servicesInterruptionAndSymptoms,
    | yang di pecah, dan diambil bagian gangguan yang memiliki gangguan $theRoot
    |
    | $theQuestionsForPageTwo = Variabel ini merupakan sisanya dari pemecahan $servicesInterruptionAndSymptoms,
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

        // $allSymptomsPerPart = [];
        // $roots = [];
        // $root = 0;
        // $theQuestions berisi seluruh gangguan, tanpa gangguannya, tinggal gejala2nya aja
        // $questions berisi seluruh gangguan, tanpa gangguannya, tinggal gejala2nya aja juga, tapi gejalanya sudah di pecah menjadia array.


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

        $symptom = $this->Internet_model->getGejalaByKode($this->open[0]);

        $data['question'] = $symptom;


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasiinternet/diagnosa', $data);
        $this->load->view('templates/footer');
    }

    public function transition()
    {
        $getData = $this->input->post();

        // var_dump($this->session->userdata('open_'));
        // die;

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
            $this->session->unset_userdata('closed_');
            $this->session->unset_userdata('open_');
            $this->session->unset_userdata('root_');
            redirect('konsultasiinternet/percentage');
        } else {

            // if ($fromRoot > count($roots)) {
            //     $this->session->set_userdata(['number_' => "1"]);
            //     $this->session->unset_userdata('closed_');
            //     $this->session->unset_userdata('open_');
            //     $this->session->unset_userdata('root_');
            //     redirect('konsultasiinternet/unknownresult');
            // }

            if ($this->session->userdata('temporary_roots_') === $this->emptyArray) {
                $this->session->unset_userdata('temporary_roots_');
                $fromRoot++;
                $number++;
                array_push($closed, array_shift($open));

                if (count($open) == 0) {
                    $this->session->set_userdata(['number_' => "1"]);
                    $this->session->unset_userdata('closed_');
                    $this->session->unset_userdata('open_');
                    $this->session->unset_userdata('root_');
                    redirect('konsultasiinternet/unknownresult');
                }

                $data = [
                    'open_' => $open,
                    'closed_' => $closed,
                    'roots_' => $roots,
                    'root_' => $fromRoot,
                    'number_' => $number
                ];
                $this->session->set_userdata($data);

                redirect('konsultasiinternet/questions/' . $number);
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
                $this->session->unset_userdata('closed_');
                $this->session->unset_userdata('open_');
                $this->session->unset_userdata('root_');
                redirect('konsultasiinternet/unknownresult');
            }

            redirect('konsultasiinternet/questions/' . $number);
        }
    }

    public function percentage()
    {
        $data['title'] = "Gangguan Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejalaByGangguan'] = $this->Internet_model->gejalaByGangguan2();

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

        $data['allKodeGangguan'] = $this->session->userdata('allKodeGangguan');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasiinternet/persentasediagnosa', $data);
        $this->load->view('templates/footer');
    }

    public function reset()
    {
        $this->session->set_userdata(['number_' => "1"]);
        $this->session->unset_userdata('closed_');
        $this->session->unset_userdata('open_');
        $this->session->unset_userdata('root_');
        $this->session->unset_userdata('temporary_roots_');
        redirect('konsultasiinternet/questions/1');
    }

    public function unknownresult()
    {
        var_dump($_SESSION);
        $data['title'] = "Gangguan Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Internet_model->getAllGangguan();
        $data['gejalaGangguan'] = $this->Internet_model->getAllGejalaCompGangguan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('konsultasiinternet/unknownresult', $data);
        $this->load->view('templates/footer');
    }

    public function result()
    {
        $data['title'] = "Gangguan Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Internet_model->getAllGangguan();
        $data['gejalaGangguan'] = $this->Internet_model->getAllGejalaCompGangguan();

        $data['results'] = $this->input->post();

        if (!$data['results']) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        $theQuestionsWithRoot = $this->session->userdata('theQuestionsWithRoot_');
        $theQuestionsWithoutRoot = $this->session->userdata('theQuestionsWithoutRoot_');

        $symptomCode = $this->session->userdata('symptomCode_');
        $isYes = $this->session->userdata('isYes_');
        $fromRoot = $this->session->userdata('fromRoot_');

        //     var_dump($theQuestionsForPageTwo);
        //     // echo "<br>";
        //     // var_dump($isYes);
        //     echo "<br>";
        //     var_dump($isFromPageOne);
        //     die;

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
        $this->load->view('konsultasiinternet/hasildiagnosa', $data);
        $this->load->view('templates/footer');
    }
}
