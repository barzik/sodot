<?php 
/**
 * @file
 * Verification model
 *
 * Including verfication functions.
 */

/**
 * @class Verification
 * @brief Including verfication functions.
 */
Class Verification {
	/**
	* The Database instance
	*/
    private $db_instance; 
	/**
	* The registry instance
	*/
	private $registry;
	/**
	* The result array variable
	*/
	private $result = array();
	/**
	* String that contains the reasons for error.
	*/
	public $error_reasons;

    /**
     * Constructor of Verification
     *
     * @param post_array   Array that includes the post values.
	 *
	 * @return          TRUE if everything OK. FALSE if some verification function failed.
     */
	
	public function __construct($post_array) {
		$this->registry = new Registry();
		$this->db_instance = Database::getInstance(); 
		$this->result['verification_check_for_double_ip'] = $this->verification_check_for_double_ip($post_array['ip']);
		$this->result['verification_filter_links'] = $this->verification_filter_links($post_array['content']);
		
		if(in_array(FALSE, $this->result) == TRUE) {
			return FALSE;
		} else {
			return TRUE;
		}
		
    }

    /**
     * Checking double submission by IP and time.
     *
     * @param ip   IP number
	 *
	 * @return          TRUE if everything OK. FALSE if the same IP tried to send another message in time limit.
     */	
	
	private function verification_check_for_double_ip($ip = null) {
		if(!$ip) {
			return FALSE;
		}
		$table = $this->registry->table_name;
		$query = sprintf("SELECT content_time FROM %s WHERE ip = :ip ORDER BY content_time DESC LIMIT 1",$table);
		$stmt = $this->db_instance->prepare($query);
		$stmt->execute(array(':ip' => $ip));
		$row = $stmt->fetch(PDO::FETCH_NUM);

		if(!$row) {
			return true;
		} 
		$time_limit = ($row[0]+$this->registry->threshold_time)*1;
		$current_time = mktime();	
		if($time_limit > $current_time) {
			$this->set_error('You can\'t send messages too quickly.');
			return false;
		} else {
			return true;
		}
	}

    /**
     * Checking if any links is there. no links are allowed here.
     *
     * @param content   The content to be checked
	 *
	 * @return          TRUE if everything OK. FALSE if the links where discovered.
     */	
	
	private function verification_filter_links($content) {
		$anchor_elements = array('http', 'www.', '.com');
		foreach ($anchor_elements as $k => $v) {
			if(strstr($content, $v)) {
				$this->set_error('No links allowed here.');
				return false;
			}
		}
		return true;
	}
	
	/**
	 * Set error to error string 
	 *
	 * @param error   the reasoon of the error.
	 */
	
	private function set_error($error) {
		$this->error_reasons .= $error;
	}


}