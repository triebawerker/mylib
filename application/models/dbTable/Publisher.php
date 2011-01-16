<?php
class Application_Model_dbTable_Publisher extends Zend_Db_Table_Abstract
{
	protected $_name = 'publisher';
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