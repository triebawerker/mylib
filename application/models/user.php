<?php
class User
{
	const ERROR_WRONG_NAME = 1;
	const ERROR_WRONG_PW = 2;
	
	protected $username = 'micha';
	protected $userpassword = 'micha';
	
	public static function User($username, $userpassword)
	{
		if ($username == $this->username) {
			return $this->username;
			
			if ($userpassword == $this->userpassword) {
				throw new Exception(self::ERROR_WRONG_PW);
			}
		} else {
			throw new Exception(self::ERROR_WRONG_NAME);	
		}		
	}
}