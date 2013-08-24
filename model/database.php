<?php
/**
 * @file
 * Database Class
 *
 * DB functions - extending PDO class
 */
 
/**
 * @class Database
 * @brief DB functions - extending PDO class
 */
class Database extends PDO
{ 	
	/**
	* The Database instance - this is a singleton based class
	*/
    private static $db_instance; 
	/**
	* The registry instance
	*/
	private static $registry;
	
	/**
     * The constructor of the Database singleton class
     */
	public static function getInstance() { 
		
		if (!self::$registry) { 
			self::$registry = new Registry();
		}
		
		if (!self::$db_instance) { 
			try {
				
				$dsn = sprintf("mysql:dbname=%s;host=%s",self::$registry->db_name, self::$registry->db_host);
				self::$db_instance = new Database($dsn, self::$registry->db_user, self::$registry->db_password); 
			} catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}   
		} 
		return self::$db_instance; 
	}  
	
	
	/**
     * Check if table exist
     *
     * @param table   	The table name
	 *
	 * @return			TrUE if table exist, FALSE if not.
     */
	
	public function checkTable($table) {
		try {
			$result = self::$db_instance->query("SELECT 1 FROM $table LIMIT 1");
		} catch (Exception $e) {
			return FALSE;
		}
		return $result;
	}
	
	/**
     * Write arrays to table
     *
     * @param array   	The data in format of key => value
	 *
	 * @return			The ID of the row inerted.
     */
	
	public function write_record($array) {
		$table = self::$registry->table_name;
		
		$cols_string = implode(',', array_keys($array));
		
		$values = array_values($array);
		foreach($array as $key => $value) {
			$pdo_array[":$key"] = "'$value'";
		}
		
		$values_string = implode(',', array_values($pdo_array));	
		$query = sprintf("INSERT INTO %s (%s) VALUES (%s)",$table,$cols_string,$values_string);
		$stmt = self::$db_instance->prepare($query);
		
		foreach($pdo_array as $key => $value) {
			$stmt->bindParam($key, $value);
		}
		$result = $stmt->execute();
		return self::$db_instance->lastInsertId();
	}
		
	
}  