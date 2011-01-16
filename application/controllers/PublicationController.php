<?php
require_once 'IndexController.php';

/**
 *Class PublicationController
 *CRUD for publication
 *@author micha
 */

class PublicationController extends IndexController
{
	
	public function preDispatch()
    {
        $this->view->render('publication/_sidebar.phtml');
    }
	
    /**
     * @todo
     * @see IndexController::indexAction()
     */
	public function indexAction()
	{
		//display last entered publications
		//display feeds
		//display last borrowed publications
	}
	
	/**
	 * insert new publication
	 * @param string publication
	 * 
	 */
	public function insertAction()
	{
		//insert new data and redirect to showAction if insert succeeds
		if ($this->getRequest()->isPost()
			&& isset($this->getRequest()->publication)
			&& $this->getRequest()->status == insert) {
				
			$data = array('publication' => $this->getRequest()->publication);
			$id = $this->_publicationModel->addPublication($data);
			
			//go to show action if update succeded or display error
			if (0 != $id || NULL !== $id) {
				$this->_redirect('publication/show?id=' . $id);			
			} else {
				$this->error = 'update failed, please try again';
			}
			
		} else {
			//show form
			$form = Application_Form_DbForm::insertPublication();
			$this->view->form = $form;
		}		
	}
	
	/**
	 * show single publication
	 * @param Integer id
	 * @return array $publication
	 * 
	 */
	public function showAction()
	{
		$id = $this->getRequest()->id;
		
		//get selected id
		$result = $this->_publicationModel->getPublication($id);
		$publication = $result->toArray();
		$this->view->publication = $publication;
	}
	
	/**
	 * 
	 * list publications
	 * @return array publication
	 */
	public function listAction()
	{
		$list = $this->_publicationModel->listPublication();
		$list->toArray();
		foreach ($list AS $values) {
			$publication[$list->current()->id]= $list->current()->publication;
		}
		$this->view->listPublication = $publication;
	}
	
	/**
	 * update publication
	 * @param integer $id
	 * @return void
	 */
	public function updateAction()
	{
		/**
		 * @todo catch error if action is not selected from show action
		 */
		//update publication or show form
		if ($this->getRequest()->status == 'update' && isset($this->getRequest()->id)) {
			
			//UPDATE data
			$id = $this->getRequest()->id;
			$publication = array(
				'publication'  => $this->getRequest()->publication,
				'publisher_id' => $this->getRequest()->publisher_id
			);
			
			try {
			$update = $this->_publicationModel->updatePublication($publication, $id);
			} catch(Exception $e) {
				$this->view->error = 'update failed: ' . $e->getMessage();
			}
		
		//go to show action if update succeded or display error
		if ($update == 1) {
			$this->_redirect('publication/show?id=' . $id);			
		} else {
			$this->error = 'update failed, please try again';
		}
		
		//show FORM
		} else {
			$id = $this->getRequest()->id;
			
			//get data for selected publication
			$resultPublication = $this->_publicationModel->getPublication($id);
			$publicationData = array(
				'id'          => $resultPublication->current()->id,
				'publication' => $resultPublication->current()->publication);
			
			$publisher = new Application_Model_Publisher();
			$resultPublisher = $publisher->getPublisherList();
			$publisherData = array();
			$resultPublisher->toArray();
			foreach ($resultPublisher AS $values) {
				$publisherData[$resultPublisher->current()->id]= $resultPublisher->current()->publisher;
			}
			//show form
			$currentPublisher = array(
				$resultPublication->current()->publisher_id,
				$publisherData[$resultPublication->current()->publisher_id]
				);
			$form = Application_Form_DbForm::updatePublication($publicationData,$publisherData,$currentPublisher);
			$this->view->form = $form;
		}
		$this->view->request = $this->getRequest();
		$this->view->result = $publisherData;
		$this->view->current = $currentPublisher;
		
	}
	
	/**
	 * 
	 * delete action should be exclusively reserved to admin
	 */
	public function deleteAction()
	{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$result = $this->_publicationModel->deletePublication($id);
			$this->view->deleted = $result;
		}

	}
}
