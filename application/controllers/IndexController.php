<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        //redirect to login if no login session user is set
    	$authSession = new Zend_Session_Namespace('auth');
		if (isset($authSession->user)) {
			$this->view->auth = $authSession->user;
		} else {
			$this->_redirect('login/index');
		}
    }

    public function indexAction()
    {

    }

    public function preDispatch()

    {
        $this->view->render('index/_sidebar.phtml');
    }
}

