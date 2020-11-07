<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manageusers extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $role_id = $this->session->userdata('role_id');

        if($role_id != 1) {
            redirect('auth/blocked');
        } 

        $this->load->model('User_model');
        $this->load->model('Request_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }
    public function index()
    {
        $data['title'] = "Manage Users";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();

        if ($this->input->post('keyword')) {
            $data['all_user'] = $this->User_model->cariDataUser();
        } else {
            $data['all_user'] = $this->User_model->getAllUser();
        }


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manageusers/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Manage Users';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['all_user'] = $this->User_model->getAllUser();
        $data['requests'] = $this->Request_model->getAllData();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Manage Users';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manageusers/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' => htmlspecialchars(ucwords($this->input->post('name', true))),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('status'),
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('users', $data);
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('manageusers');
        }
    }


    public function ubah($id)
    {
        $data['title'] = 'Manage Users';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['single_user'] = $this->User_model->getUserById($id);
        $data['requests'] = $this->Request_model->getAllData();        

        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pakarheader', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('manageusers/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->User_model->ubahDataUser();
            $this->session->set_flashdata('flash', 'Diubah');

            redirect('manageusers');
        }
    }

    public function hapus($id)
    {
        $this->User_model->hapusDataUser($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('manageusers');
    }
};
