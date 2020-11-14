<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manageinternet extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();


        $this->load->model('Internet_model');
        $this->load->model('Request_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        $data['title'] = "Manage Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manageinternet/index', $data);
        $this->load->view('templates/footer');
    }

    public function gangguan()
    {
        $data['title'] = "Manage Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();

        if ($this->input->post('keyword')) {
            $data['gangguan'] = $this->Internet_model->cariDataGangguan();
        } else {
            $data['gangguan'] = $this->Internet_model->getAllGangguan();
        }

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manageinternet/gangguan', $data);
        $this->load->view('templates/footer');
    }

    public function tambahgangguan()
    {
        $data['title'] = 'Manage Internet Fiber';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Internet_model->getAllGangguan();
        $data['requests'] = $this->Request_model->getAllData();

        $id_user = $data['user']['id'];

        $this->form_validation->set_rules('namagangguan', 'Nama Gangguan', 'required');
        $this->form_validation->set_rules('solusi', 'Solusi', 'required|min_length[12]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manageinternet/tambahgangguan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Internet_model->tambahDataGangguan($id_user);
            if ($data['user']['role_id'] == 3) {
                $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
            } else {
                $this->session->set_flashdata('flash', 'Ditambahkan');
            }
            redirect('manageinternet/gangguan');
        }
    }

    public function ubahgangguan($id)
    {
        $data['title'] = 'Manage Internet Fiber';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Internet_model->getGangguanById($id);
        $data['requests'] = $this->Request_model->getAllData();

        $id_user = $data['user']['id'];

        $this->form_validation->set_rules('namagangguan', 'Nama Gangguan', 'required');
        $this->form_validation->set_rules('solusi', 'Solusi', 'required|min_length[12]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manageinternet/ubahgangguan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Internet_model->ubahDataGangguan($id_user);
            if ($data['user']['role_id'] == 3) {
                $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
            } else {
                $this->session->set_flashdata('flash', 'Diubah');
            }

            redirect('manageinternet/gangguan');
        }
    }

    public function hapusgangguan($id, $kode)
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->Internet_model->hapusDataGangguan($id, $kode);
        if ($data['user']['role_id'] == 3) {
            $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
        } else {
            $this->session->set_flashdata('flash', 'Dihapus');
        }

        redirect('manageinternet/gangguan');
    }

    public function gejala()
    {
        $data['title'] = "Manage Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();


        if ($this->input->post('keyword')) {
            $data['gejala'] = $this->Internet_model->cariDataGejala();
        } else {
            $data['gejala'] = $this->Internet_model->getAllGejala();
        }

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manageinternet/gejala', $data);
        $this->load->view('templates/footer');
    }

    public function tambahgejala()
    {
        $data['title'] = 'Manage Internet Fiber';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejala'] = $this->Internet_model->getAllGejala();
        $data['requests'] = $this->Request_model->getAllData();

        $id_user = $data['user']['id'];


        $this->form_validation->set_rules('namagejala', 'Nama Gejala', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manageinternet/tambahgejala', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Internet_model->tambahDataGejala($id_user);
            if ($data['user']['role_id'] == 3) {
                $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
            } else {
                $this->session->set_flashdata('flash', 'Ditambahkan');
            }
            redirect('manageinternet/gejala');
        }
    }

    public function ubahgejala($id)
    {
        $data['title'] = 'Manage Internet Fiber';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejala'] = $this->Internet_model->getGejalaById($id);
        $data['requests'] = $this->Request_model->getAllData();

        $id_user = $data['user']['id'];

        $this->form_validation->set_rules('namagejala', 'Nama Gejala', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manageinternet/ubahgejala', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Internet_model->ubahDataGejala($id_user);
            if ($data['user']['role_id'] == 3) {
                $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
            } else {
                $this->session->set_flashdata('flash', 'Diubah');
            }

            redirect('manageinternet/gejala');
        }
    }

    public function hapusgejala($id)
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->Internet_model->hapusDataGejala($id);
        if ($data['user']['role_id'] == 3) {
            $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
        } else {
            $this->session->set_flashdata('flash', 'Dihapus');
        }
        redirect('manageinternet/gejala');
    }

    public function rules()
    {
        $data['title'] = "Manage Internet Fiber";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Internet_model->getAllGangguan();
        $data['gejala'] = $this->Internet_model->getAllGejala();
        $data['requests'] = $this->Request_model->getAllData();

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manageinternet/rules', $data);
        $this->load->view('templates/footer');
    }
};
