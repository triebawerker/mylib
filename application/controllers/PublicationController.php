<?php
/**
 * require IndexController.php
 */
require_once 'IndexController.php';

/**
 *Class PublicationController
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
		if(isset($_POST['publication']) AND $_POST['status'] == insert){
			$data = array('publication' => $_POST['publication']);
			$addPublication = new Application_Model_Publication();
			$id = $addPublication->addPublication($data);
			
			//go to show action if update succeded or display error
			if(0 != $id || NULL !== $id) {
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
		
		$getPublication = new Application_Model_Publication();
		//get selected id
		$result = $getPublication->getPublication($id);
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
		$listPublication = new Application_Model_Publication();
		$list = $listPublication->listPublication();
		$list->toArray();
		foreach($list AS $values) {
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
		//update publication or show form
		if($_POST['status'] == 'update' && isset($_POST['id'])) {
			
			//update data
			$id = $_POST['id'];
			$data = array('publication' => $_POST['publication']);
			
			try {
			$updatePublication = new Application_Model_Publication();
			$update = $updatePublication->updatePublication($data, $id);
			} catch(Exception $e) {
				$this->view->error = 'update failed: ' . $e->getMessage();
			}
		
		//go to show action if update succeded or display error
		if($update == 1) {
			$this->_redirect('publication/show?id=' . $id);			
		} else {
			$this->error = 'update failed, please try again';
		}

		
		} else if (isset($_GET['id'])) {
			$id = $this->getRequest()->id;
			
			//get data for selected publication
			$getPublication = new Application_Model_Publication();
			$result = $getPublication->getPublication($id);
			$data = array(
				'id'          => $result->current()->id,
				'publication' => $result->current()->publication);
			//show form
			$form = Application_Form_DbForm::updatePublication($data);
			$this->view->form = $form;
		}
		
		else {$this->view->test = 'ELSE';$this->view->request = $this->getRequest()->getParams();}
	}
	
	/**
	 * 
	 * delete action should be exclusively reserved to admin
	 */
	public function deleteAction()
	{
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		$deletePublication = new Application_Model_Publication();
		$result = $deletePublication->deletePublication($id);
		$this->view->deleted = $result;
		}

	}
}
?>