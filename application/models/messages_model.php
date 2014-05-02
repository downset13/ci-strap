<?php

class Messages_model extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->adminEmail = $this->config->item('admin_email');
    }
	
	function sendEmail($to, $from, $fromEmail, $replyTo, $replyToEmail, $subject, $message, $signature) {
		$headers = "From: $from <$fromEmail>";
		if ($replyTo != "") {
			$headers .= "\r\nReply-To: $replyTo <$replyToEmail>";
		}
		$messagewsignature = $message . "\r\n\r\n" . $signature;
		
		$snd = @mail($to, $subject, $messagewsignature, $headers);
	}	
	
	/** 
	* Sends lost password email containing change_password URL with unique MD5'd token.
	*/
	function sendPasswordEmail($email, $token) {
		$url =  site_url("login/change_password");
		$url .= "/".$token;
	
		$to = $email;
		$from = 'CI-Strap';
		$fromEmail = $this->adminEmail;
		$replyTo = 'CI-Strap';
		$replyToEmail = $this->adminEmail;
		$subject = "CI-Strap Password Reset";
		$message = "Hello,\r\n\r\nIt seems that you've lost your password.  To change your password, follow the link below.  If you did not request a password reset, please ignore this email.\r\n\r\n$url";
		$signature = "CI-Strap Admin\r\n";

		$this->sendEmail($to, $from, $fromEmail, $replyTo, $replyToEmail, $subject, $message, $signature);
	}

}