<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->user_model->is_logged_in();
	}
	
	function index()
	{
		$data['admins'] = $this->user_model->getUsersByGroup('admin');
		$data['pageTitle'] = 'Main';
		
		$this->load->view('pages/main', $data);
	}
	
	function logout()
	{
		$this->session->unset_userdata('is_logged_in');
		redirect('login');
	}

}
