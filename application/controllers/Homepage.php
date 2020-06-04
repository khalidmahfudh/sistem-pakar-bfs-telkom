<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Login First!</div>');
			redirect('auth');
		}

		$this->load->library('form_validation');
		$this->load->helper('form');
	}
	public function index()
	{
		$data['title'] = "Home Page";
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('homepage/index', $data);
		$this->load->view('templates/footer');
	}
}
