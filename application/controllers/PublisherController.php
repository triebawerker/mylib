<?php
require_once 'Zend/Controller/Action.php';

/**
 * PublisherController
 * CRUD for publisher
 * @author micha
 *
 */

class PublisherController extends Zend_Controller_Action
{
	/**
	 * put code here
	 */
	public function indexAction()
	{
		$this->view->hello = "Publisher bearbeiten";
	}
}