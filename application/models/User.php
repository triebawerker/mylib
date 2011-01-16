<?php
class Application_Model_User
{
	private $table;
	
	public function __construct()
	{
		if(!isset($this->table)) {
			$this->table = new Application_Model_dbTable_User();
		}	
	}
	
	/**
	 * 
	 * get user
	 * @param int $id
	 */
	public function getPublication($id)
	{
		$result = $this->table->find($id);
		return $result;
	}
}
?>