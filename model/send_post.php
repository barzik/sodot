<?php
/**
 * @file
 * Send post model
 *
 * Activating the FaceBook API for sending the message to the FB page
 */
include_once("third_party/facebook-php-sdk-master/src/facebook.php");


 /**
 * @class Send_post
 * @brief Activating the FaceBook API for sending the message to the FB page
 */
Class Send_post {
	/**
	* The registry instance
	*/
	private $registry;
	/**
	* The page id
	*/
	private $page_id = '';
	/**
	* The post url - right now we are not using it
	*/
    private $post_url = '';
	/**
	* The page access token
	*/
    private $page_access_token = '';

	
	/**
     * Constructor of Send_post
     *
     * @param message   	the message text
     */
	
	 public function __construct($message) {
		$this->registry = new Registry();
		$this->page_id = $this->registry->page_id;
		$this->page_access_token = $this->registry->page_access_token;
		
		$this->post_url = 'https://graph.facebook.com/'.$this->page_id.'/feed';
		$result = $this->message(array( 'message'     => $message['content']) );
        return TRUE;
     } 


	 /**
     * Sending message with FaceBook API and Curl
     *
     * @param data   	array, basicly including the content
	 *
	 * @return			TRUE if success.
     */
	 
	 
    public function message($data)
    {   
        $data['access_token'] = $this->page_access_token;
 
        $ch = curl_init();
 
        curl_setopt($ch, CURLOPT_URL, $this->post_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
        $return = curl_exec($ch);

		
		if(curl_errno($ch)) {
			echo 'Curl error: ' . curl_error($ch);
		}
		
		curl_close($ch);
 
        return $return;        
    }
}