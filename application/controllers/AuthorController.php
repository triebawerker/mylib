<?php
include_once 'IndexController.php';

class AuthorController extends IndexController
{	
	/**
	 * 
	 * list author
	 * @return array publication
	 */
	public function listAction()
	{
		$list = $this->_authorModel->listAuthor();
		$list->toArray();
		foreach ($list AS $values) {
			$author[$list->current()->id]= $list->current()->last_name;
		}
		$this->view->listAuthor = $author;
	}
}
?>