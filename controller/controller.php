<?php 
/**
 * @file
 * Controller
 *
 * The controller of the application - including router
 */
include_once("model/model.php");

 /**
 * @class Controller
 * @brief The controller of the application - including router
 */
class Controller {
	/**
	 * The model instance
	 */
     public $model;	

	 /**
     * Constructor of Controller.
     */
     public function __construct()
     {
          $this->model = new Model();
     } 

	 /**
     * The routing functions that decide which view to load.
     */
     public function invoke()
     {  
		switch ($_GET['page']) {
			case 'install':
				$install = new Install();
				print $install->getResult();
				break;
			case 'message':
				if(isset($_REQUEST['message'])) {
					$message = array('message' => $_REQUEST['message'],
							'header' => $_REQUEST['header']);
					$return_message_array = $this->model->process_post($message);	
				}	  
				include 'view/main_page.php';
				break;
			 default:
				header('Location: '.$_SERVER['PHP_SELF'].'?page=message');
				break;
		}
     }	 
}