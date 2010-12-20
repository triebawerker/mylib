<?php
include_once 'models/user.php';

class authAdapter implements Zend_Auth_Adapter_Interface
{
	const BAD_PASSWORD = 'Bad Password';
	const WRONG_USER = 'Wrong Username';
	
	protected $user;
	protected $username;
	protected $userpassword;
	
	public function __construct($username, $userpassword)
	{
		$this->username = $username;
		$this->userpassword = $userpassword;
	}
	
	 /**
     * Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot be performed
     * @return Zend_Auth_Result
     */
	public function authenticate()
	{
	
		try {

			$this->user = user::User($this->username, $this->userpassword);
			return  $this->createResult(Zend_Auth_Result::SUCCESS);
			
			
		} catch (Zend_Auth_Adapter_Exception $e) {
			if($e->getMessage() == User::ERROR_WRONG_NAME) {
				return $this->createResult(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, array(self::WRONG_USER));
			}
		
			if($e->getMessage() == User::ERROR_WRONG_PW) {
				return $this->createResult(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, array(self::BAD_PASSWORD));
			}
		}	
	}
	
	private function createResult($code,$message = array())
	{
		return new Zend_Auth_Result($code, $this-User,$message);
	}
}