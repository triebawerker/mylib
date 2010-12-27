<?php
class Application_Form_AuthForm
{
	public $_authForm;
	
	public static function formLogin()
	{
		$form = new Zend_Form();
		$form->setAction('Index/login')
			 ->setMethod('post');
		
		//add Form Elements
		$form->addElement('text','username');
//		$password = new Zend_Form_Element_Text('text','password');
//		$password->setRequired(true);
		$form->addElement('submit','login');
		
		return $form;
		
	}
}
?>