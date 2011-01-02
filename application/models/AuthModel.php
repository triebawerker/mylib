<?php
require_once 'DbConnection.php';

class Application_Model_AuthModel
{
	
	private static $auth;
	
	/**
	 * protected
	 */
	public function __construct ()
	{				  

    }

    public static function setUpAuthAdapter()
    {

    	
		$db = Application_Model_DbConnection::getConnection();
		
		//set auth class
		$auth = new Zend_Auth_Adapter_DbTable($db);
		
		//set table and column name
		$auth->setTableName('user')
		     ->setIdentityColumn('user_name')
		     ->setCredentialColumn('password');
		     
		self::$auth = $auth;
		return $auth;
    	}
    
}
?>