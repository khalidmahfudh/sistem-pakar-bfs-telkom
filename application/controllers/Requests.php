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
    }
    public function index()
    {
        $data['title'] = "All Requests";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['requests'] = $this->Request_model->getAllData();
        $data['gangguan_internet'] = $this->Internet_model->getAllGangguanWithIsActiveZero();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('requests/index', $data);
        $this->load->view('templates/footer');
    }

    public function accept($id_gangguan, $id_request)
    {

        $this->Request_model->accept($id_gangguan,$id_request);
        $this->session->set_flashdata('flash', 'Dipermohonkan');

        redirect('requests');
    }

    public function reject($id,$kode)
    {
        $this->Request_model->reject($id,$kode);
        $this->session->set_flashdata('flash', 'Diubah');

        redirect('requests');
    }
    
};
