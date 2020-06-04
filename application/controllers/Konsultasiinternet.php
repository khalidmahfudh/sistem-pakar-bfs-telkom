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
            $questions = $this->Internet_model->getAllGejala();  
            $question[0] = $questions[0];
            $data['question'] = $question;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiinternet/diagnosa', $data);
            $this->load->view('templates/footer');

        } else if ( $param == 'second' ){
            $data['questions'] = $selectedQue2;      

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('konsultasiinternet/diagnosa2', $data);
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
                    redirect('konsultasiinternet/diagnosa/persentase');
                } else {
                    redirect('konsultasiinternet/diagnosa/second');
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
                    redirect('konsultasiinternet/diagnosa/unknownresult');
                } else {
                    redirect('konsultasiinternet/diagnosa/persentase');
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
            $this->load->view('konsultasiinternet/persentasediagnosa', $data);
            $this->load->view('templates/footer');



        } else if ( $param == 'result' ){

            $data['results'] = $this->input->post();
            var_dump($this->input->post());die;


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
            $this->load->view('konsultasiinternet/hasildiagnosa', $data);
            $this->load->view('templates/footer');


        } else if ( $param == 'unknownresult' ){
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
