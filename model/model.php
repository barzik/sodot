<?php 
/**
 * @file
 * model main loader
 *
 * Loading all of the models
 */

include_once("model/registry.php");
include_once("model/database.php");
include_once("model/process_post.php");
include_once("model/send_post.php");
include_once("model/install.php");
include_once("model/verification.php");


 /**
 * @class Model
 * @brief Loading all of the models
 */
 
class Model {

	/**
     * Processing the post
     *
     * @param post   	the post array
	 *
	 * @return			result array - very similiar to post but include errors. no errors = everythink OK.
     */


	public function process_post($post)
	{
		$this->process_post = new Process_post($post);
		return $this->process_post->get_result();
	}
}
