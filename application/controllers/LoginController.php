<?php
		
class LoginController extends Zend_Controller_Action
{
	private $_loginForm;
	
	public function indexAction()
	{
		//check username and password
		if($_POST['username'] && $_POST['password']) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			//check login data
			$auth = Application_Model_AuthModel::setUpAuthAdapter();
			$auth->setIdentity($username);
			$auth->setCredential($password);
			//$auth->setCredentialTreatment('MD5(?)');
			$result = $auth->authenticate();
			$code = $result->getCode();
			
			switch ($code) {
				case Zend_Auth_Result::FAILURE:
					$error = "unknown error";
					break;
				case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
					$error = "Wrong user";
					break;
				case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
					$error = "Wrong password";
					break;
			}
			
			if (isset($error)) {
				$this->view->error = $error;
				
			} else if (Zend_Auth_Result::SUCCESS) {
				$this->view->login = array($username);
				
				//set session
				$authSession = new Zend_Session_Namespace('auth');
				$authSession->user = $username;
			}
			
			$this->render('login');
			
		} else {
			//get Form
			$form = Application_Form_AuthForm::formLogin();
	
			//get login form
			$this->_loginForm = new Application_Model_AuthModel();

			$this->view->hello = $this->_loginForm;
			$this->view->hello = $test;
			$this->view->cwd = getcwd();
			#
	        $this->view->form = $form;
	        $this->render('index');
		}
		
	}
	


}
?>