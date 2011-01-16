<?php
class Application_Model_dbTable_User
{
	protected $_name = 'user';
	protected $_schema = 'bibliography';
	protected $_primary = 'id';
	protected $_sequence = true;
	
	private $db;
	
	public function __construct()
	{
		if(!isset($this->db)) {
			$this->db = Application_Model_DbConnection::getConnection();
		
		}
		$this->_setAdapter($this->db);
		parent::__construct();
	}
}
?>