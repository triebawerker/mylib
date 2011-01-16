<?php

class IndexController extends Zend_Controller_Action
{
	protected $_authorModel;
	protected $_publicationModel;
	protected $_publisherModel;
	protected $_userModel;
	
    public function init()
    {
        //redirect to login if no login session user is set
    	$authSession = new Zend_Session_Namespace('auth');
		if (isset($authSession->user)) {
			/**
			 * @todo write this into session
			 */
			$this->view->auth = $authSession->user;
			$this->view->role = $authSession->role;
		} else {
			$this->_redirect('login/index');
		}
		
		$aclSession = new Zend_Session_Namespace('acl');
		if (isset($aclSession->acl)) {
			$this->view->acl = $aclSession->acl;
		}
		
		//initialize models
		//user
//		if (!isset($this->userModel)) {
//			$this->_userModel = new Application_Model_User();
//		}
		
		//publication
		if(!isset($this->publicationModel)) {
			$this->_publicationModel = new Application_Model_Publication();
		}
		
		//publisher
    	if(!isset($this->_publisherModel)) {
			$this->_publisherModel = new Application_Model_Publisher();
		}
		
		//@author micha
		if(!isset($this->_authorModel)) {
			$this->_authorModel = new Application_Model_Author();
		}
    }
    
    public function preDispatch()

    {
        $this->view->render('index/_sidebar.phtml');
    }
    
    public function indexAction()
    {

    }


}

