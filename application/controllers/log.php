<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->user_model->is_logged_in();
		$this->user_model->hasRolePermission(array('admin'));
	}
	
	/* Show 25 most-recent log entries of user activity. */
	function index()
	{
		$data['log'] = $this->log_model->getLog();
		$data['pageTitle'] = 'System Log';
		
		$this->load->view('pages/admin/log', $data);
	}

}
