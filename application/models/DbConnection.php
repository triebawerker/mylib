<?php
class Application_Model_DbConnection
{
	private static $connect;
    private static $opts = array(
    				  'host'     => 'localhost',
					  'username' => 'admin',
					  'password' => 'micha',
					  'dbname'   => 'bibliography'		 
				  	);
				  	
	public static function getConnection()
	{    
		if(!isset(self::$connect)) {
    		self::$connect = Zend_Db::factory('Pdo_Mysql', self::$opts);
    	}
    	
    	//set db adapter
		
    	return self::$connect;
    }
		
}
?>