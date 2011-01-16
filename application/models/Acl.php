<?php
class Application_Model_Acl
{
	/**
	 * Object with access control list
	 * @var object $acl
	 */
	private static $acl;
	
	/**
	 *
	 * initialize acl if not yet set
	 */
	
	public static function initAcl()
	{
		if (!isset(self::$acl)) {
		//create new acl
		$acl = new Zend_Acl();
		
		//set up roles
		$acl->addRole(new Zend_Acl_Role('guest'))
			->addRole(new Zend_Acl_Role('member'), 'guest')  //inherits from guest
			->addRole(new Zend_Acl_Role('admin'), 'member'); //inherits from member
			
		//set up resources
		$acl->addResource('read')
			->addResource('borrow');
		
		//allocate resources to roles
		$acl->allow('guest', 'read')
			->allow('member', array('borrow'))
			->allow('admin');
		self::$acl = $acl;
		}
		return self::$acl;
	}
}
?>