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
	public static $vars = array();
	
	// Store the single instance of Registry
    private static $registry; 

    /**
     * Constructor of Registry
     */
	private function __construct() {
		self::$vars = parse_ini_file(realpath('../settings.ini'));
	}
	
	/**
	* Signleton get instance implementation
	*/ 
	
	public static function getInstance() { 
		if (!self::$registry) { 
			self::$registry = new Registry(); 
		} 
		return self::$registry; 
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
        self::$vars[$key] = $val;
    }
	
	/**
     * Getter of registry item
     *
     * @param key   The key of the item
	 *
	 * @return	The value of the registry item. NULL if not item was found.
     */

	public function __get($key) {
		if (array_key_exists($key, self::$vars)) {
			return self::$vars[$key];
		} else {
			return null;
		}
    }
	
	
	
}