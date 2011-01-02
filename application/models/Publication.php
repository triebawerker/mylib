<?php
class Application_Model_Publication
{
	private $table;
	
	public function __construct()
	{
		if(!isset($this->table)) {
			$this->table = new Application_Model_dbTable_Publication();
		}	
	}
	
	/**
	 * 
	 * Insert new data
	 * @param array $data
	 */
	public function insertPublication($data)
	{
		$this->table->insert($data);
	}
	
	/**
	 * 
	 * fetch all data
	 * @return object $result
	 */
	public function listPublication()
	{
		$result = $this->table->fetchAll();
		return $result;
	}
}
?>