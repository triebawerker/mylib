<?php
class Application_Model_DbTable_Publisher extends Zend_Db_Table_Abstract
{
	protected $_name = 'publisher';
	protected $_schema = 'bibliography';
	protected $_primary = 'id';
	protected $_sequence = true;
	protected $_dependentTables = array('Application_Model_DbTable_Publication');
		protected $referenceMap = array(
		'publication' => array(
			'columns'       => 'publisher_id',
			'refTableClass' => 'Application_Model_DbTable_Publication',
			'refColumn'     => 'id',
			'onDelete'      => self::CASCADE,
			'onUpdate' 	    => self::CASCADE
			)
		);	
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