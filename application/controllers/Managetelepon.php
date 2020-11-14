<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Managetelepon extends CI_Controller
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
        $data['title'] = "Manage Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('managetelepon/index', $data);
        $this->load->view('templates/footer');
    }

    public function gangguan()
    {
        $data['title'] = "Manage Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();

        if ($this->input->post('keyword')) {
            $data['gangguan'] = $this->Telepon_model->cariDataGangguan();
        } else {
            $data['gangguan'] = $this->Telepon_model->getAllGangguan();
        }

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('managetelepon/gangguan', $data);
        $this->load->view('templates/footer');
    }

    public function tambahgangguan()
    {
        $data['title'] = 'Manage Telepon Rumah';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Telepon_model->getAllGangguan();
        $data['requests'] = $this->Request_model->getAllData();

        $id_user = $data['user']['id'];

        $this->form_validation->set_rules('namagangguan', 'Nama Gangguan', 'required');
        $this->form_validation->set_rules('solusi', 'Solusi', 'required|min_length[12]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('managetelepon/tambahgangguan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Telepon_model->tambahDataGangguan($id_user);
            if ($data['user']['role_id'] == 3) {
                $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
            } else {
                $this->session->set_flashdata('flash', 'Ditambahkan');
            }
            redirect('managetelepon/gangguan');
        }
    }

    public function ubahgangguan($id)
    {
        $data['title'] = 'Manage Telepon Rumah';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Telepon_model->getGangguanById($id);
        $data['requests'] = $this->Request_model->getAllData();

        $id_user = $data['user']['id'];

        $this->form_validation->set_rules('namagangguan', 'Nama Gangguan', 'required');
        $this->form_validation->set_rules('solusi', 'Solusi', 'required|min_length[12]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('managetelepon/ubahgangguan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Telepon_model->ubahDataGangguan($id_user);
            if ($data['user']['role_id'] == 3) {
                $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
            } else {
                $this->session->set_flashdata('flash', 'Diubah');
            }

            redirect('managetelepon/gangguan');
        }
    }

    public function hapusgangguan($id, $kode)
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->Telepon_model->hapusDataGangguan($id, $kode);
        if ($data['user']['role_id'] == 3) {
            $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
        } else {
            $this->session->set_flashdata('flash', 'Dihapus');
        }

        redirect('managetelepon/gangguan');
    }

    public function gejala()
    {
        $data['title'] = "Manage Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();


        if ($this->input->post('keyword')) {
            $data['gejala'] = $this->Telepon_model->cariDataGejala();
        } else {
            $data['gejala'] = $this->Telepon_model->getAllGejala();
        }

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('managetelepon/gejala', $data);
        $this->load->view('templates/footer');
    }

    public function tambahgejala()
    {
        $data['title'] = 'Manage Telepon Rumah';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejala'] = $this->Telepon_model->getAllGejala();
        $data['requests'] = $this->Request_model->getAllData();

        $id_user = $data['user']['id'];


        $this->form_validation->set_rules('namagejala', 'Nama Gejala', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('managetelepon/tambahgejala', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Telepon_model->tambahDataGejala($id_user);
            if ($data['user']['role_id'] == 3) {
                $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
            } else {
                $this->session->set_flashdata('flash', 'Ditambahkan');
            }
            redirect('managetelepon/gejala');
        }
    }

    public function ubahgejala($id)
    {
        $data['title'] = 'Manage Telepon Rumah';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gejala'] = $this->Telepon_model->getGejalaById($id);
        $data['requests'] = $this->Request_model->getAllData();

        $id_user = $data['user']['id'];

        $this->form_validation->set_rules('namagejala', 'Nama Gejala', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('managetelepon/ubahgejala', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Telepon_model->ubahDataGejala($id_user);
            if ($data['user']['role_id'] == 3) {
                $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
            } else {
                $this->session->set_flashdata('flash', 'Diubah');
            }

            redirect('managetelepon/gejala');
        }
    }

    public function hapusgejala($id)
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->Telepon_model->hapusDataGejala($id);
        if ($data['user']['role_id'] == 3) {
            $this->session->set_flashdata('flash', 'Diajukan ke Pakar');
        } else {
            $this->session->set_flashdata('flash', 'Dihapus');
        }
        redirect('managetelepon/gejala');
    }

    public function rules()
    {
        $data['title'] = "Manage Telepon Rumah";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['gangguan'] = $this->Telepon_model->getAllGangguan();
        $data['gejala'] = $this->Telepon_model->getAllGejala();
        $data['requests'] = $this->Request_model->getAllData();

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('managetelepon/rules', $data);
        $this->load->view('templates/footer');
    }
};
