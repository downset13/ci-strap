<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->user_model->is_logged_in();
		$this->user_model->hasRolePermission(array('admin'));
	}
	
	/* Users Page Index: View basic user info with ability
	to edit user-group and activate/deactivate users. */
	function index()
	{
		$data = array();
		$data['users'] = $this->user_model->getAll();
		$data['count'] = count($data['users']);
		$data['pageTitle'] = 'User Management';
		if($this->session->flashdata('message')){
			$data['message'] = $this->session->flashdata('message');
		}
		$this->load->view('pages/admin/users', $data);
	}
	
	/* Activate User. */
	function activate_user() {
		$uid = $this->uri->segment(3);
		$this->user_model->activate($uid);
		$this->session->set_flashdata('message','Selected account as been successfully activated.');
		redirect('users');
	}
	
	/* Deactivate User - can be reactivated. */
	function deactivate_user() {
		$uid = $this->uri->segment(3);
		$this->user_model->deactivate($uid);
		$this->session->set_flashdata('message','Selected account as been successfully deactivated.');
		redirect('users');
	}
	
	/* Change user-group (Administrator, Power User, Basic User, ...). */
	function update_user_group() {
		if ($this->input->post('ajax') == "1") {
			$group = $this->input->post('group');
			$uid = $this->input->post('uid');
			
			$this->user_model->updateUserGroup($uid,$group);
		}
	}
	
	/* View/Edit a specific user. */
	function user() {
		$uid = $this->uri->segment(3);
		$data = array();
		$data['user'] = $this->user_model->getUser($uid);
		$data['pageTitle'] = 'User Management';
		$this->load->view('pages/admin/user', $data);
	}
	
	/* Delete a specific user (Permanent removal via database). */
	function delete() {
		$uid = $this->input->post('uid');
		$user = $this->user_model->getUser($uid);
		$this->user_model->delete($uid);
		$this->session->set_flashdata('message',$user->username . ' has been successfully deleted.');
		redirect('users');
		
	}
}
