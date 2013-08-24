<?php 
/**
 * @file
 * Process post model
 *
 * Processing the initial content - including verifying it and writing the logs.
 */
 
 /**
 * @class Process_post
 * @brief Processing the initial content - including verifying it and writing the logs.
 */
 
Class Process_post {
	/**
	* The post array variable
	*/
	public static $post;
	/**
	* The Database instance
	*/
    private $db_instance; 
	/**
	* The registry instance
	*/
	private $registry;
	/**
	* The result of the process
	*/
	private $result = array();

    /**
     * Constructor of Process_post
     *
     * @param post   Array that includes the post values.
     */
	
	public function __construct($post) {
		$this->registry = new Registry();
		$this->db_instance = Database::getInstance(); 
		
        $this->result['content'] = $this->sanitise_post($post['message']);
		$this->result['ip'] = $_SERVER['REMOTE_ADDR'];
		$this->result['content_time'] = mktime();	
		$verification = new Verification($this->result);
		if($verification->error_reasons != '') {
			$this->result['error'] = $verification->error_reasons;
			return $this->result;
		} else {
			$sent_message = $this->send_message($this->result);
			if($sent_message == TRUE) {
				$this->write_message($this->result);
			}
			return $this->result;
		}
    }
	
	 /**
     * getter if the result of the constructor
     */
	
	public function get_result() {
		return $this->result;
	}

	
	 /**
	 * Sender of the message - should be called only after proper verification and sanitisation.
	 *
	 * @param text   Santised text to be send to the DataBase and FB API.
	 */
	private function send_message($text) {
		$send_post = new Send_post($text);
		if($send_post == TRUE) {
			return TRUE;
		} else {
			$this->result['error'] = $send_post;
			return FALSE;
		}
	}
	
	/**
	 * write the message to the DB
	 *
	 * @param array   santised array to be sent to the DB.
	 */

	private function write_message($array) {	
		$result = $this->db_instance->write_record($array);
		return $result;
	}
	
	/**
	 * Sanitise text.
	 *
	 * @param post 	  string
	 *
	 * @return        santised text
	 */
	
	
	private function sanitise_post($post) {
		$post = filter_var($post, FILTER_SANITIZE_STRING);
		return $post;
	}
	
	/**
	 * Sanitise IP.
	 *
	 * @param post   ip number
	 *
	 * @return          IP number if everything is OK. string error if something went bad.
	 */
	
	private function sanitise_ip($ip) {
		$reg_ex ='/^((?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))*$/';
		$ip = addslashes(htmlspecialchars(strip_tags(trim($ip))));
		if (ereg($reg_ex, $ip_address)) { 
			return $ip;
		} else {
			$this->post_error('Bad IP');
		}
	}
	
	/**
	 * Set error to result array
	 *
	 * @param reason   the reasoon of the error.
	 */
	
	private function post_error($reason = NULL) {
		$this->result['error'] = $reason;
		return;
	}	

}