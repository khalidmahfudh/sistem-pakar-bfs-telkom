<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasiinternet extends CI_Controller
{
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

    public function diagnosa($param)
    {
        $data['title'] = "Gangguan Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejalaByGangguan'] = $this->Internet_model->gejalaByGangguan2();

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
                $theQuestionsForPageOne[$i] = $interruption;
                $i++;
            } else {
                $theQuestionsForPageTwo[$j] = $interruption;
                $j++;
            }
        }

        // -------------------------------------------------------------------------- //

        if ($param == 'first') {
            $data['gejalaCode'] = 1;
            $allSymptoms = $this->Internet_model->getAllGejala();
            $symptom = $allSymptoms[0];
            $data['question'] = $symptom;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiinternet/diagnosa', $data);
            $this->load->view('templates/footer');
        } else if ($param == 'second') {
            $data['questions'] = $theQuestionsForPageTwo;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiinternet/diagnosa2', $data);
            $this->load->view('templates/footer');
        } else if ($param == 'transition') {

            $str = ($this->input->post('radio1'));
            $radio = explode("-", $str);

            /* Apakah berasal dari halaman 1? */
            if ($radio[2] == 1) {

                $symptomCode = $radio[0];
                $isYes = $radio[1];
                $isFromPageOne = $radio[2];

                $data = [
                    'symptomCode_' => $symptomCode,
                    'isYes_' => $isYes,
                    'isFromPageOne_' => $isFromPageOne
                ];
                $this->session->set_userdata($data);

                if ($isYes == '1') {
                    redirect('konsultasiinternet/diagnosa/persentase');
                } else {
                    redirect('konsultasiinternet/diagnosa/second');
                }

                /* Apakah berasal dari halaman 2? */
            } elseif ($radio[2] == 2) {


                $symptomCode = $radio[0];
                $isYes = $radio[1];
                $isFromPageOne = $radio[2];


                $data = [
                    'symptomCode_' => $symptomCode,
                    'isYes_' => $isYes,
                    'isFromPageOne_' => $isFromPageOne
                ];

                $this->session->set_userdata($data);

                if ($symptomCode == '999') {
                    redirect('konsultasiinternet/diagnosa/unknownresult');
                } else {
                    redirect('konsultasiinternet/diagnosa/persentase');
                }
            } else {
                // jika berasal dari halaman 3
            }
        } else if ($param == 'persentase') {

            $symptomCode = $this->session->userdata('symptomCode_');
            $isYes = $this->session->userdata('isYes_');
            $isFromPageOne = $this->session->userdata('isFromPageOne_');

            $data['symptomCode'] = $symptomCode;

            if ($isFromPageOne == '1') {
                $data['questions'] = $theQuestionsForPageOne;
            } else {

                // var_dump(count(array_slice($theQuestionsForPageOne[0], 3)));
                // die;
                $j = 0;

                foreach ($theQuestionsForPageOne as $questionPageOne) {
                    for ($i = 0; $i < count(array_slice($questionPageOne, 3)); $i++) {
                        if (array_slice($questionPageOne, 3)[$i] == $symptomCode) {
                            $selected[$j] = $questionPageOne;
                            $j++;
                        }
                    }
                }

                var_dump($questionPageOne);
                die;


                foreach ($theQuestionsForPageTwo as $questionPageTwo) {
                    for ($i = 0; $i < count(array_slice($questionPageTwo, 3)); $i++) {
                        if (array_slice($questionPageTwo, 3)[$i] == $symptomCode) {
                            $selected[$j] = $questionPageTwo;
                            $j++;
                        }
                    }
                }

                var_dump($selected);
                die;


                $data['questions'] = $selected;
            }

            $data['allKodeGangguan'] = $this->session->userdata('allKodeGangguan');


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiinternet/persentasediagnosa', $data);
            $this->load->view('templates/footer');
        } else if ($param == 'result') {

            $data['results'] = $this->input->post();

            if (!$data['results']) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }

            $symptomCode = $this->session->userdata('symptomCode_');
            $isYes = $this->session->userdata('isYes_');
            $isFromPageOne = $this->session->userdata('isFromPageOne_');

            var_dump($theQuestionsForPageTwo);
            // echo "<br>";
            // var_dump($isYes);
            echo "<br>";
            var_dump($isFromPageOne);
            die;

            if ($isFromPageOne == '1') {
                $data['questions'] = $theQuestionsForPageOne;
            } else {

                $j = 0;

                foreach ($theQuestionsForPageOne as $questionPageOne) {
                    for ($i = 0; $i < count(array_slice($questionPageOne, 3)); $i++) {
                        if (array_slice($questionPageOne, 3)[$i] == $symptomCode) {
                            $selected[$j] = $questionPageOne;
                            $j++;
                        }
                    }
                }

                foreach ($theQuestionsForPageTwo as $questionPageTwo) {
                    for ($i = 0; $i < count(array_slice($questionPageTwo, 3)); $i++) {
                        if (array_slice($questionPageTwo, 3)[$i] == $symptomCode) {
                            $selected[$j] = $questionPageTwo;
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
            $this->load->view('konsultasiinternet/hasildiagnosa', $data);
            $this->load->view('templates/footer');
        } else if ($param == 'unknownresult') {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiinternet/unknownresult', $data);
            $this->load->view('templates/footer');
        } else {

            redirect('konsultasiinternet/index');
        }
    }
}
