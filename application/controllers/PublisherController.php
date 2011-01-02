<?php
require_once 'IndexController.php';

/**
 * PublisherController
 * CRUD for publisher
 * @author micha
 *
 */

class PublisherController extends IndexController
{

	public function preDispatch()

    {
        $this->view->render('publisher/_sidebar.phtml');
    }
	
	public function indexAction()
	{
		$this->view->result = $this->getRequest()->publisher;

	}
	
	public function showAction()
	{
		$id = $this->getRequest()->id;
		
		$getPublisher = new Application_Model_Publisher();
		//get selected id
		$result = $getPublisher->getPublisher($id);
		$this->view->publisher = $result;
	}
	
	public function addAction()
	{
		if (isset($_POST['publisher'])) {
		$publisher = $_POST['publisher'];
		
		//save publisher
		$newPublisher = new Application_Model_Publisher();
		
		//get result as array: affected rows and publisher
		//redirect to index if new publisher is stored
		//else output error message
		$result = $newPublisher->savePublisher($publisher);
			if($result['affectedRows'] == 1) {
				$this->_redirect('publisher/index?publisher=' . $result['publisher']);
			}
			else $this->view->error = "Publisher not saved";
		} else {
		
		//form add publisher
		$form = Application_Form_DbForm::publisher();
		$this->view->form = $form;
		}
	}
	
	public function listAction()
	{
		$listPublisher = new Application_Model_Publisher();
		$list = $listPublisher->listPublisher();
		$this->view->listPublisher = $list;
	}
	
	public function editAction()
	{
	    //check if id is set: update or show form
		if (isset($_POST['id'])) {
			$arrayEdit = array(
				'publisher' => $_POST['publisher'],
				);
			$id = $_POST['id'];
				
		//update db
		$editPublisher = new Application_Model_Publisher();
		
		try {
		$edit = $editPublisher->editPublisher($arrayEdit,$id);
		} catch (Exception $e) {
			$this->error = $e->getMessage();
		}
		//go to show action if update succeded or display error
		if($edit == 1) {
			$this->_redirect('publisher/show?id=' . $id);			
		} else {
			$this->error = 'update failed, please try again';
		}
		
	    } elseif (isset($_GET['id'])) {
	    $id = $_GET['id'];
	    //show form
	    //get values for selected id
	    $getPublisher = new Application_Model_Publisher();
		$result = $getPublisher->getPublisher($id);
	    
	    //get form
	    $form = Application_Form_DbForm::editPublisher($result);
	    $this->view->id = $id;
	    $this->view->form = $form;
	    }
		

	}
	
	public function searchAction()
	{
		if($_POST['status'] == 1){
			//search
			$searchData = array('string' => $_POST['string']);
			
			$searchPublisher = new Application_Model_Publisher();
			$result = $searchPublisher->searchPublisher($searchData);
			$this->view->result = $result;
			
		} else {
			//display search form
			$form = Application_Form_DbForm::searchPublisher();
			$this->view->form = $form;
		}
		
	}
}