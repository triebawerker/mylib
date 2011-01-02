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
	 * @todo
	 * Enter description here ...
	 */
	public function insertAction()
	{
		if(isset($_POST['publication'])) {
			
			//set up array $data
			//insert new data
			//forward to indexAction
		} else {
			
			//display form
		}
	}
	/**
	 * @todo
	 * Enter description here ...
	 */
	public function showAction()
	{
		$id = $this->getRequest()->id;
		
		$getPublisher = new Application_Model_Publisher();
		//get selected id
		$result = $getPublisher->getPublisher($id);
		$this->view->publisher = $result;
	}
	
	/**
	 * 
	 * list publications
	 * return array to the view
	 */
	public function listAction()
	{
		$listPublication = new Application_Model_Publication();
		$list = $listPublication->listPublication();
		
		foreach($list AS $values) {
			$publication[]['publication'] = $list->current()->publication;
		}
		$this->view->listPublication = $publication;
	}
}
?>