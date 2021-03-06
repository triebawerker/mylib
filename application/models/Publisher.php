<?php
require_once 'DbConnection.php';

class Application_Model_Publisher
{
	private $db;
	private $table;
	
	/**
	 * instantiate db connection
	 */
	public function __construct() {
		if(!isset($this->db)) {
			$this->db = Application_Model_DbConnection::getConnection();
		}
		
		//for active record
		if(!isset($this->table)) {
		$this->table = new Application_Model_DbTable_Publisher();
		}
	}
	
	public function savePublisher($publisher) {
		$sql = "INSERT INTO publisher (publisher) VALUES (:publisher)";
		$query = $this->db->prepare($sql);
		$query->bindParam('publisher', $publisher);
		
		$query->execute();
		$returnValues['affectedRows'] = $query->rowCount();
		$returnValues['publisher'] = $publisher;
		return $returnValues;
	}
	
	public function listPublisher() {
		$sql = "SELECT * FROM publisher";
		$result = $this->db->query($sql);
		$list = $result->fetchAll(Zend_Db::FETCH_ASSOC);
		return $list;
	}
	
	/**
	 * 
	 * get Publisher for selected ID
	 * @param integer $id
	 * @return array $result
	 */
	
	public function getPublisher($id)
	{
		$result = $this->table->find($id);
		return $result;
	}
	
	/**
	 * 
	 * Update table publisher
	 * @param array $data ('columnname' => 'Value')
	 * @param integer $id
	 * @return array $result
	 */
	public function editPublisher($data,$id)
	{
		if(Null === $id || '' == $id){
			throw new Exception('Id is missing, please select a publisher');
		}
		$result = $this->db->update('publisher', $data, 'id = ' . $id);
		return $result;
	}
	
	/**
	 * Search for publisher
	 * @param mixed $string
	 * @return array $result
	 */
	
	public function searchPublisher($searchData)
	{
		if(!isset($searchData)) {
			throw new Exception('no data for search found');
		}
		
		$sql = "SELECT * FROM publisher WHERE publisher LIKE '%" . $searchData['string'] . "%' ";
		$row = $this->db->query($sql);
		$result = $row->fetchAll(Zend_Db::FETCH_ASSOC);
		return $result;
	}
	
	
	/**
	 * get a list of all publishers with id and name for pulldown menus
	 * @return array $result
	 */
	public function getPublisherList()
	{
		$result = $this->table->fetchAll();
		return $result;
	}
}
?>