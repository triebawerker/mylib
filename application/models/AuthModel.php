<?php
class Application_Model_AuthModel
{
    private $_db;
    private $_auth;
    private $_opts = array('host' => 'localhost',
					  'username' => 'admin',
					  'password' => 'micha',
					  'dbname' => 'bibliography'		 
				  	);
	/**
	 * protected
	 */
	public function __construct ()
	{				  

    }
    
    /**
     * 
     * Singleton
     */
    public static function setUpAuthAdapter()
    {
    	if(isset($this->$auth)) {
    		return $this->$auth;
    	} else {
    	
    	//set db adapter
		$this->_db = Zend_Db::factory('Pdo_Mysql', $this->opts);
		
		//set auth class
		$this->_auth = new Zend_Auth_Adapter_DbTable($this->db);
		
		//set table and column name
		$this->_auth->setTableName('user')
		     ->setIdentityColumn('user_name')
		     ->setCredentialColumn('password');
		return $this->$auth;
    	}
    }
}
?>