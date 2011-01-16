<?php
class Application_Form_AuthForm
{
	
	public static function formLogin()
	{
		$form = new Zend_Form();
		$form->setAction('index')
			 ->setMethod('post');
		
		//add Form Elements
		$form->addElement('text', 'username');
		$form->addElement('text', 'password');
		$form->addElement('submit','login');
		
		return $form;
		
	}
}
?>