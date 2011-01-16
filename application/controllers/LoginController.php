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
			
			/**
			 * @todo $auth->setCredentialTreatment('MD5(?)');
			 */
			$result = $auth->authenticate();
			$code = $result->getCode();
			//$test = $result->;
			
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
				
				//get user role
						//get selected id
//				$result = $this->_publicationModel->getPublication($id);
//				$publication = $result->toArray();
//				$this->view->publication = $publication;
				
				$user_role = 'user';
				
				//set session for auth: username and role
				try {
				$authSession = new Zend_Session_Namespace('auth');
				$authSession->user = $username;
				$authSession->role = $user_role;
				} catch (Zend_Auth_Exception $e) {
					$this->view->error = 'Session for authorization failed: ' . $e->getMessage();
				}
				
				//set session for access control list
				$aclSession = new Zend_Session_Namespace('acl');
				$aclSession->acl = Application_Model_Acl::initAcl();
			}

			$this->render('login');
			
		} else {
			//get Form
			$form = Application_Form_AuthForm::formLogin();
	
	        $this->view->form = $form;
	        $this->render('index');
		}
		
	}
	


}
?>