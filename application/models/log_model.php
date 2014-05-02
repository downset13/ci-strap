<?php

class Log_model extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->logTable = $this->config->item('table_prefix').'log';
    }
	
	/* Pull 25 most recent log entries. */
	function getLog() {
		$this->db->order_by('timestamp', 'desc');
		$this->db->limit(25);
		return $this->db->get($this->logTable)->result();
	}
	
	/* Add entry to log. */
	function addLog($username, $message) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$data = array('username' => $username, 'message' => $message, 'ipAddr' => $ip);
		$this->db->insert($this->logTable, $data);
	}

}