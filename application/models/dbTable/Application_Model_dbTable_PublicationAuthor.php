<?php
class Application_Model_dbTable_PublicationAuthor
{
	protected $_name = 'publicationAuthor';
	protected $_schema = 'bibliography';
	protected $_primary = 'id';
	protected $_sequence = true;

	protected $referenceMap = array(
		'publication' => array(
			'columns'       => 'publication_id',
			'refTableClass' => 'Publication',
			'refColumn'     => 'id',
			'onDelete'      => self::CASCADE,
			'onUpdate' 	    => self::CASCADE
			),
		'author' => array(
			'columns'		=> 'author_id',
			'refTableClass' => 'Author',
			'refColumn'		=> 'id',
			'onDelete'		=> self::CASCADE,
			'onUpdate'		=> self::CASCADE
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