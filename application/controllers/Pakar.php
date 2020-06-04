<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pakar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = "My Profile";
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/pakarheader', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pakar/index', $data);
        $this->load->view('templates/footer');
    }
};
