<?php
class Application_Model_Author
{
	private $table;
	
	public function __construct()
	{
		if(!isset($this->table)) {
			$this->table = new Application_Model_dbTable_Author();
		}	
	}
	
	/**
	 * 
	 * Insert new data
	 * @param array $data
	 */
	public function insertAuthor($data)
	{
		$this->table->insert($data);
	}
	
	/**
	 * 
	 * fetch all data
	 * @return object $result
	 */
	public function listAuthor()
	{
		$result = $this->table->fetchAll();
		return $result;
	}
	
	/**
	 * 
	 * get single publication
	 * @param unknown_type $id
	 */
	public function getAuthor($id)
	{
		$result = $this->table->find($id);
		return $result;
	}
	
	/**
	 * update Publication
	 * @param integer $id
	 * @return void
	 */
	
	public function updateAuthor($author, $id)
	{
		if(isset($id)){
		$update = $this->table->update(Author, 'id=' . $id);
		}
		return $update;
	}
	
	/**
	 * 
	 * add new publication
	 * @param array $data
	 * @return mixed $add returns key or keys
	 */
	public function addAuthor($data)
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
	public function deleteAuthor($id)
	{
		$where = $this->table->getAdapter()->quoteInto('id = ?', $id);
		$delete = $this->table->delete($where);
		return $delete;
	}
}
?>