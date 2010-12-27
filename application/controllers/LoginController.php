<?php
		
class LoginController extends Zend_Controller_Action
{
	private $_loginForm;
	
	public function indexAction()
	{
		//get Form
		$form = Application_Form_AuthForm::formLogin();

		//get login form
		$this->_loginForm = new Application_Model_AuthModel();
		$test = $this->autoloader;
		$this->view->hello = $this->_loginForm;
		$this->view->hello = $test;
		$this->view->cwd = getcwd();
		#
        $this->view->form = $form;
        $this->render('index');
		
	}
	
}
?>