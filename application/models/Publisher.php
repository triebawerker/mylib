<?php
require_once 'DbConnection.php';

class Application_Model_Publisher
{
	private $db;
	
	/**
	 * instantiate db connection
	 */
	public function __construct() {
		if(!isset($this->db)) {
			$this->db = Application_Model_DbConnection::getConnection();
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
		$sql = "SELECT id, publisher FROM publisher WHERE id = $id";
		/*
		 * @todo bind param
		 */
//		$stmt = $this->db->prepare($sql);
//		$stmt->bindParam(':id', $id);
		
		$row = $this->db->query($sql);
		$result = $row->fetch(Zend_Db::FETCH_ASSOC); 
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
}
?>