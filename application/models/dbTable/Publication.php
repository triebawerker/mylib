<?php
class Application_Model_dbTable_Publication extends Zend_Db_Table_Abstract
{
	protected $_name = 'publication';
	protected $_schema = 'bibliography';
	protected $_primary = 'id';
	protected $_sequence = true;

	protected $dependentTables = array('publisher','publicationAuthor');
	protected $referenceMap = array(
		'publisher' => array(
			'columns'       => 'publisher_id',
			'refTableClass' => 'Publication',
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