<?php
/**
 * @file
 * Install model
 *
 * Model that install the application on MySQL
 */

/**
 * @class Install
 * @brief Model that install the application on MySQL
 */
class Install {

/**
 * The DB instance
 */
private $db_instance;
/**
 * result array
 */
private $result;
/**
 * The registry instance
 */
private $registry;

	/**
     * Constructor of Install
     */

	public function __construct() {
		$this->registry = Registry::getInstance();
		$this->db_instance = Database::getInstance(); 
		$this->createTable($this->registry->table_name);
		
    } 
	
	/**
     * getting the result of the installation process.
	 * @return boolean
     */
	
	public function getResult() {
			$results = $this->db_instance->exec(sprintf("SHOW TABLES LIKE '%s'", $this->registry->table_name));
			if(!$results) {
				return FALSE;
			}
			if($results->rowCount()>0){
				return TRUE;
			}
	}
	
	
	/**
     * Creating table
     *
     * @param table   	Table name
	 *
	 * @return			TRUE if success.
     */
	 
	private function createTable($table) {

		if($this->db_instance->checkTable($table)) {
			return 'Table exists';
		}
			
		$create_table = sprintf("CREATE TABLE IF NOT EXISTS %s", $table);
		$fields = array(
			'id' => 'SERIAL  PRIMARY KEY',
			'content_time' => 'BIGINT NOT NULL',
			'ip' => 'VARCHAR(30) NOT NULL',
			'content' => 'TEXT NOT NULL'
		);	
		$fields_string = '';
		foreach($fields as $field => $type) {
		  $fields_string.= "$field $type,";
		}
		$fields_string = substr($fields_string, 0, -1);
		
		$sql_query = "$create_table ($fields_string) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'";
		try {
			$result = $this->db_instance->exec($sql_query);
			return $result;
		} catch (Exception $e) {
				print $e;
		}
	}
	
}