<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manageuseetv extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Useetv_model');
        $this->load->model('Request_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        $data['title'] = "Manage UseeTV";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manageuseetv/index', $data);
        $this->load->view('templates/footer');
    }

    public function gangguan()
    {
        $data['title'] = "Manage UseeTV";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();

        if ($this->input->post('keyword')) {
            $data['gangguan'] = $this->Useetv_model->cariDataGangguan();
        } else {
            $data['gangguan'] = $this->Useetv_model->getAllGangguan();
        }

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manageuseetv/gangguan', $data);
        $this->load->view('templates/footer');
    }

    public function tambahgangguan()
    {
        $data['title'] = 'Manage UseeTV';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Useetv_model->getAllGangguan();
        $data['requests'] = $this->Request_model->getAllData();

        $this->form_validation->set_rules('namagangguan', 'Nama Gangguan', 'required');
        $this->form_validation->set_rules('solusi', 'Solusi', 'required|min_length[12]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manageuseetv/tambahgangguan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Useetv_model->tambahDataGangguan();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('manageuseetv/gangguan');
        }
    }

    public function ubahgangguan($id)
    {
        $data['title'] = 'Manage UseeTV';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Useetv_model->getGangguanById($id);
        $data['requests'] = $this->Request_model->getAllData();

        $this->form_validation->set_rules('namagangguan', 'Nama Gangguan', 'required');
        $this->form_validation->set_rules('solusi', 'Solusi', 'required|min_length[12]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manageuseetv/ubahgangguan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Useetv_model->ubahDataGangguan();
            $this->session->set_flashdata('flash', 'Diubah');

            redirect('manageuseetv/gangguan');
        }
    }

    public function hapusgangguan($id, $kode)
    {
        $this->Useetv_model->hapusDataGangguan($id, $kode);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('manageuseetv/gangguan');
    }

    public function gejala()
    {
        $data['title'] = "Manage UseeTV";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();
        $data['gejala'] = $this->Useetv_model->getAllGejala();

        if ($this->input->post('keyword')) {
            $data['gejala'] = $this->Useetv_model->cariDataGejala();
        } else {
            $data['gejala'] = $this->Useetv_model->getAllGejala();
        }

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manageuseetv/gejala', $data);
        $this->load->view('templates/footer');
    }

    public function tambahgejala()
    {
        $data['title'] = 'Manage UseeTV';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejala'] = $this->Useetv_model->getAllGejala();
        $data['requests'] = $this->Request_model->getAllData();

        $this->form_validation->set_rules('namagejala', 'Nama Gejala', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manageuseetv/tambahgejala', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Useetv_model->tambahDataGejala();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('manageuseetv/gejala');
        }
    }

    public function ubahgejala($id)
    {
        $data['title'] = 'Manage UseeTV';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejala'] = $this->Useetv_model->getGejalaById($id);
        $data['requests'] = $this->Request_model->getAllData();

        $this->form_validation->set_rules('namagejala', 'Nama Gejala', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manageuseetv/ubahgejala', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Useetv_model->ubahDataGejala();
            $this->session->set_flashdata('flash', 'Diubah');

            redirect('manageuseetv/gejala');
        }
    }

    public function hapusgejala($id)
    {
        $this->Useetv_model->hapusDataGejala($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('manageuseetv/gejala');
    }

    public function rules()
    {
        $data['title'] = "Manage UseeTV";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Useetv_model->getAllGangguan();
        $data['gejala'] = $this->Useetv_model->getAllGejala();
        $data['requests'] = $this->Request_model->getAllData();

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manageuseetv/rules', $data);
        $this->load->view('templates/footer');
    }
};
