<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->user_model->is_logged_in();
	}
	
	/* Account Page Index: View personal user information
	with options to edit the info and change password. */
	function index()
	{
		$data = array();
		$data['errors'] = array();
		$data['user'] = $this->user_model->getUserByUsername($this->session->userdata('username'));
		$data['pageTitle'] = 'Account';
		if($this->session->flashdata('message')){
			$data['message'] = $this->session->flashdata('message');
		}
		$this->load->view('pages/admin/account', $data);
	}
	
	/* Save changes to account */
	function save_user() {
		if($_SERVER['REQUEST_METHOD'] != "POST") {
			redirect('account');
		}
		
		$errors = array();
		$data = array();

		$data['user'] = $this->user_model->getUserByUsername($this->session->userdata('username'));

		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$pass = $this->input->post('pass');
		$pass2 = $this->input->post('pass2');

		// Validate Saved User Settings
		if (!empty($pass)) {
			if ($pass != $pass2) {
				$errors['pass2'] = "Passwords do not match";
			}
			if (strlen($pass) < 8) {
				$errors['pass'] = 'Password must be at least 8 characters long';
			}
		}
		if (empty($email)) {
			$errors['email'] = 'Provide your E-mail address';
		}
		if ($this->user_model->emailExists($email) && $email != $data['user']->email) {
			$errors['email'] = 'This E-mail address you entered is already being used';
		}
		$symbols = array("/",".","-","(",")","#"," ");
		$phone = str_replace($symbols, "", $phone);
		if (!empty($phone) && strlen($phone) != 10) {
			$errors['phone'] = 'Phone number invalid.  Please include your area code (ex. 555-555-5555)';
		}

		$userdata = array(
			'email' => $email,
			'phone' => $phone
		);

		if (empty($errors['pass']) && empty($errors['pass2']) && !empty($pass)) {
			$userdata['password'] = $this->passwordhash->HashPassword($pass);
		}
		
		if (empty($errors)) {
			$this->user_model->updateUser($userdata);
			$this->session->set_flashdata('message','You have successfully changed your settings.');
			redirect('account');
		}
					
		$data['errors'] = $errors;
		$data['pageTitle'] = 'Account';
		$this->load->view('pages/admin/account', $data);	
	}

}
