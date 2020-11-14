<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Requests extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Request_model');
        $this->load->model('Internet_model');
        $this->load->model('Telepon_model');
        $this->load->model('Useetv_model');
    }
    public function index()
    {
        $data['title'] = "All Requests";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('requests/index', $data);
        $this->load->view('templates/footer');
    }

    public function accept($id)
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->Request_model->accept($id);
        $this->session->set_flashdata('flash', $data['user']['name'] . ' Di Terima');

        redirect('requests');
    }

    public function reject($id)
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->Request_model->reject($id);
        $this->session->set_flashdata('flash', $data['user']['name'] . ' Di Tolak');
        redirect('requests');
    }
};
