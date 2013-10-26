<?php
/**
 * @file
 * Registry model
 *
 * Basic PHP based registry
 */
 
 /**
 * @class Registry
 * @brief Basic PHP based registry
 */
class Registry {

	/**
	* The variables of the registry 
	*/
	public $vars = array();

    /**
     * Constructor of Registry
     */
	public function __construct() {
		$this->vars = parse_ini_file(realpath('../settings.ini'));
	}
	
	 /**
     * Setter of registry item
     *
     * @param key   The key of the item
	 * @param val   The value of the item
	 *
	 * @return NULL
     */
	
    public function __set($key, $val) {
        $this->vars[$key] = $val;
    }
	
	/**
     * Getter of registry item
     *
     * @param key   The key of the item
	 *
	 * @return	The value of the registry item. NULL if not item was found.
     */

	public function __get($key) {
		if (array_key_exists($key, $this->vars)) {
			return $this->vars[$key];
		} else {
			return null;
		}
    }
	
	
	
}