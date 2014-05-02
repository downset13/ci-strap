<?php
class User_model extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->usersTable = $this->config->item('table_prefix').'users';
		$this->adminEmail = $this->config->item('admin_email');
    }
	
	function getAll() {
		$this->db->order_by('lname', 'asc');
		return $this->db->get($this->usersTable)->result();
	}
	
	/*
	* ~~~~~~~~~~~~~~~~~~
	* PASSWORD FUNCTIONS
	* ~~~~~~~~~~~~~~~~~~
	*/
	function newPassword($email, $password) {
		$this->db->where('email', $email);
		$this->db->update($this->usersTable, array('password' => $this->passwordhash->HashPassword($password)));
	}
	
	function updatePasswordByToken($token, $password) {
		$this->db->where('token', $token);
		$this->db->update($this->usersTable, array('password' => $this->passwordhash->HashPassword($password)));
	}
	
	function createPasswordToken($email, $token) {
		$this->db->where('email', $email);
		$this->db->update($this->usersTable, array('token' => $token));
	}
	
	function checkPasswordToken($token) {
		$this->db->where('token', $token);
		$exists = $this->db->get($this->usersTable);
		if($exists->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}
	
	function eraseToken($token) {
		$this->db->where('token', $token);
		$this->db->update($this->usersTable, array('token' => ''));
	}	
	
	function validate() {
		$password = $this->input->post('password');
		$username = $this->input->post('username');
		
		$this->db->where('username', $username);
		$query = $this->db->get($this->usersTable);
		if($query->num_rows() == 1) {
			$user = $query->row();
			if ($this->passwordhash->CheckPassword($password, $user->password)) {
				if ($user->active) {
					$this->db->where('username', $username);
					$this->db->update($this->usersTable, array('last_login' => date('Y-m-d H:i:s')));
					return true;
				}
			}
		}
		return false;
	}
	
	function addRequest($data) {
		$hash = $this->passwordhash->HashPassword($data['pass']);
		$request = array(
			'fname' => $data['fname'],
			'lname' => $data['lname'],
			'email' => $data['email'],
			'username' => $data['username'],
			'password' => $hash,
			'active' => 'false',
			'group' => 'user'
		);
		$this->db->insert($this->usersTable, $request);
	}
	/*
	* ~~~~~~~~~~~~~~~~~~
	* UPDATE USER FUNCTIONS
	* ~~~~~~~~~~~~~~~~~~
	*/
	function updateUserGroup($uid, $group) {
		$this->db->where('uid', $uid);
		$this->db->update($this->usersTable, array('group' => $group));
		
		$user = $this->getUser($uid);
		
		$this->log_model->addLog($this->currentUser()->username,'User group updated for ' . $user->fname . ' ' . $user->lname . '.');
	}
	
	function updateUser($userdata) {
		$user = $this->currentUser();
		
		$this->db->where('uid', $user->uid);
		$this->db->update($this->usersTable, $userdata);
		
		$this->log_model->addLog($user->username,'Updated their personal information.');
	}
	
	function activate($uid) {
		$this->db->where('uid', $uid);
		$this->db->update($this->usersTable, array('active' => 'true'));
		
		$user = $this->getUser($uid);
		
		$message = $user->fname." ".$user->lname.",\r\n";
		$message.= " \r\n";
		$message.= "Your account has been activated!  You may login at the link below with the credentials you specified:\r\n";
		$message.= "\r\n";
		$message.= $this->config->item('base_url');
		
		$signature.= "CI-Strap\r\n";
		$signature.= $this->adminEmail . "\r\n";
		
		$this->messages_model->sendEmail($user->email, 'CI-Strap', $this->adminEmail, 'CI-Strap', $this->adminEmail, 'Account Activated', $message, $signature);
	
		$this->log_model->addLog($this->currentUser()->username,'Activated user account for ' . $user->fname . ' ' . $user->lname . '.');
	
	}
	
	function deactivate($uid) {
		$this->db->where('uid', $uid);
		$this->db->update($this->usersTable, array('active' => 'false'));
		
		$user = $this->getUser($uid);
		
		$message = $user->fname." ".$user->lname.",\r\n";
		$message.= " \r\n";
		$message.= "Your account has been deactivated.  If you have any questions, please contact your administrator.\r\n";
		
		$signature.= "CI-Strap\r\n";
		$signature.= $this->adminEmail . "\r\n";
		
		$this->messages_model->sendEmail($user->email, 'CI-Strap', $this->adminEmail, 'CI-Strap', $this->adminEmail, 'Account Deactivated', $message, $signature);
		
		$this->log_model->addLog($this->currentUser()->username,'Deactivated user account for ' . $user->fname . ' ' . $user->lname . '.');
	
	}
	
	function delete($uid) {
		$user = $this->getUser($uid);
		$this->db->delete($this->usersTable, array('uid' => $uid));
		$this->log_model->addLog($this->currentUser()->username,'Permanently deleted user ' . $user->fname . ' ' . $user->lname . '.');	
	}
	/*
	* ~~~~~~~~~~~~~~~~~~
	* GET USER(S) INFO FUNCTIONS
	* ~~~~~~~~~~~~~~~~~~
	*/	
	function getUser($uid) {
		$this->db->where('uid', $uid);
		return $this->db->get($this->usersTable)->first_row();
	}
		
	function getUserByUsername($username) {
		$this->db->where('username', $username);
		return $this->db->get($this->usersTable)->first_row();
	}
	
	function getUsersByGroup($group) {
		$this->db->where('group',$group);
		return $this->db->get($this->usersTable)->result();
	}
	
	function usernameExists($username) {
		$this->db->where('username', $username);
		if ($this->db->get($this->usersTable)->num_rows() == 1) {
			return true;
		}
		return false;
	}
	
	function userIsActive($uid) {
		$this->db->where('uid', $uid);
		$this->db->where('active', 'true');
		$query = $this->db->get($this->usersTable);
		
		if ($query->num_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
	}
	/*
	* ~~~~~~~~~~~~~~~~~~
	* SESSION USER FUNCTIONS
	* ~~~~~~~~~~~~~~~~~~
	*/
	function currentUser() {
		$this->db->where('uid', $this->session->userdata('uid'));
		return $this->db->get($this->usersTable)->first_row();
	}
	
	function isCurrentUser($uid){
		if($this->session->userdata('uid') == $uid){
			return true;
		}else{
			return false;
		}
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || $is_logged_in != true || !$this->userIsActive($this->session->userdata('uid'))) {
			redirect('login');
		}
	}
	
	function is_admin()
	{
		if ($this->group() != "admin") {
			redirect('main');
		}
	}
	
	function group() {
		$this->db->select('group');
		$this->db->where('username', $this->session->userdata('username'));
		return $this->db->get($this->usersTable)->first_row()->group;
	}

	function hasRole($roles) {
		$this->db->select('group');
		$this->db->where('username', $this->session->userdata('username'));
		if (in_array($this->db->get($this->usersTable)->first_row()->group,$roles)) {
			return true;
		}
		return false;
	}
	
	function hasRolePermission($roles) {
		if (!$this->hasRole($roles)) {
			$this->log_model->addLog($this->currentUser()->username, 'User attempted to access ' . uri_string() . ', but does not have permission.');
			redirect('main');
		}
	}
	/*
	* ~~~~~~~~~~~~~~~~~~
	* OTHER FUNCTIONS
	* ~~~~~~~~~~~~~~~~~~
	*/
	function emailExists($email) {
		$this->db->where('email', $email);
		if ($this->db->get($this->usersTable)->num_rows() > 0) {
			return true;
		}
		return false;
	}
	
}