<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function Main()
	{
	    parent::Controller();
	}
	
	/** 
	* Forces https:// and loads login page view.
	*/
	function index()
	{
		/* Force SSL - make sure to add your URL
		if ($_SERVER['SERVER_PORT'] != 443)
		{
		    redirect('https://');
	    }*/
		$data = array();
		if($this->session->flashdata('message')){
			$data['message'] = $this->session->flashdata('message');
		}
		$this->load->view('pages/login', $data);
	}
	
	
	/** 
	* Checks user credentials.  If user is valid, session data is created
	* and they are logged in.
	*/
	function validate() {
		$validUser = $this->user_model->validate();
		
		if ($validUser) { // if the user's credentials validate...
			$u = $this->user_model->getUserByUsername($this->input->post('username'));
			$uid = $u->uid;
			$data = array(
				'uid' => $uid,
				'username' => $this->input->post('username'),
				'fname' => $this->user_model->getUser($uid)->fname,
				'lname' => $this->user_model->getUser($uid)->lname,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			
			redirect('main');
		}
		else {
			$data['errors']['login'] = "Errors Exist";
			$data['user']['username'] = $this->input->post('username');
			$this->load->view('pages/login', $data);
		}	
	}
	
	
	/** 
	* Loads blank request access view.
	*/
	function request() {
		$this->load->view('pages/access/request_access');
	}
	
	/** 
	* Posts request access form data and checks for errors.
	* If error free, adds request.
	*/
	function submit_request() {
		$data = array();
		$errors = array();
		
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$pass = $this->input->post('password');
		$pass2 = $this->input->post('password2');
		
		$data['fname'] = $fname;
		$data['lname'] = $lname;
		$data['email'] = $email;
		$data['group'] = 'user';
		$data['username'] = $username;
		$data['pass'] = $pass;
		$data['pass2'] = $pass2;
		
		if (empty($fname)) {
			$errors['fname'] = 'Provide your first name';
		}
		if (empty($lname)) {
			$errors['lname'] = 'Provide your last name';
		}
		if (empty($email)) {
			$errors['email'] = 'Provide your E-mail address';
		}
		if ($this->user_model->emailExists($email)) {
			$errors['email'] = 'This E-mail address is already being used';
		}
		if (empty($username)) {
			$errors['username'] = 'Type your desired username';
		}
		if ($this->user_model->usernameExists($username)) {
			$errors['username'] = 'The username you requested is already taken';
		}
		if (empty($pass)) {
			$errors['pass'] = 'Password invalid';
		}
		if (strlen($pass) < 8) {
			$errors['pass'] = 'Password must be at least 8 characters long';
		}
		if ($pass2 != $pass || empty($pass2)) {
			$errors['pass2'] = 'Passwords do not match';
		}
		
		$data['errors'] = $errors;
		
		if ($errors) {
			$this->load->view('pages/access/request_access', $data);
		}
		else {
			$this->user_model->addRequest($data);	
			$this->session->set_flashdata('message','Success!  Your account has been created and is waiting for approval.<br/>You will receive an email when it has been activated.');
			redirect('login');
		}	
	}
	
	
	/** 
	* Lost password request page.
	* Checks for valid email.  If valid, creates password token
	* and sends email with unique link (based on token) to user.
	* Redirects to main login page if successful.
	*/
	function password() {
		$data = array();
		if ($this->input->server('REQUEST_METHOD') === 'POST')  {
			$email = $this->input->post('email');
			if (!$this->user_model->emailExists($email)) {
				$errors = array();
				$data['email'] = $email;
				$errors['email'] = "Oops! We can't find that email address.";
				$data['errors'] = $errors;
			}else{
				$token = md5(uniqid(mt_rand(), true));
				$this->user_model->createPasswordToken($email, $token);
				$this->messages_model->sendPasswordEmail($email, $token);
				$this->session->set_flashdata('message','Success!  Instructions have been sent to your email.');
				redirect('login');
			}	
		}
		$this->load->view('pages/password/password', $data);	
	}
	
	/** 
	* Lost password modification page.
	* Validates token in URI segment. If no token or invalid,
	* redirect to login page.  If valid, load password_change
	* view.  If form posts without errors, update password
	* and erase the token.
	*/
	function change_password() {
		$data = array();
		$errors = array();
		
		$token = $this->uri->segment(3);
		$data['token'] = $token;
		
		$exists = $this->user_model->checkPasswordToken($token);
		
		if($exists && $token != ''){
			if ($this->input->server('REQUEST_METHOD') === 'POST')  {
				$pass = $this->input->post('password');
				$pass2 = $this->input->post('password2');
				$data['pass'] = $pass;
				$data['pass2'] = $pass2;
				
				if (empty($pass)) {
				$errors['pass'] = 'Password invalid';
				}
				if (strlen($pass) < 8) {
					$errors['pass'] = 'Password must be at least 8 characters long';
				}
				if ($pass2 != $pass || empty($pass2)) {
					$errors['pass'] = 'Passwords do not match.';
				}
				$data['errors'] = $errors;
				
				if ($errors) {
					$this->load->view('pages/password/password_change', $data);
				}else{
					$this->user_model->updatePasswordByToken($token,$pass);
					$this->user_model->eraseToken($token);
					$this->session->set_flashdata('message','Success!  Your password has been changed.');
					redirect('login');
				}
			}else{
				$this->load->view('pages/password/password_change',$data);
			}
		}else{
			redirect('login');
		}
	}
	
}
