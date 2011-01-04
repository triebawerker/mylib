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
	
	public function getPublication($id)
	{
		$result = $this->table->find($id);
		return $result;
	}
	
	/**
	 * update Publication
	 * @param integer $id
	 * @return void
	 */
	
	public function updatePublication($data, $id)
	{
		if(isset($id)){
		$update = $this->table->update($data, 'id=' . $id);
		}
		return $update;
	}
	
	/**
	 * 
	 * add new publication
	 * @param array $data
	 * @return mixed $add returns key or keys
	 */
	public function addPublication($data)
	{
		$add = $this->table->insert($data);
		return $add;
	}
	
	/**
	 * 
	 * delete publication
	 * @param integer $id
	 * @return integer $delete number of deleted rows
	 */
	public function deletePublication($id)
	{
		$where = $this->table->getAdapter()->quoteInto('id = ?', $id);
		$delete = $this->table->delete($where);
		return $delete;
	}
}
?>