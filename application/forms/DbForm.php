<?php
class Application_Form_DbForm
{
	public static function publisher()
	{
		$form = new Zend_Form();
		$form->setAction('add');
		$form->setMethod('pOST');
		
		//add form elements
		$form->addElement('text', 'publisher',
					array('label' => 'Publisher')
					);
		$form->addElement('submit', 'add');
		
		return $form;
	}
	
	/**
	 * 
	 * Form edit publisher data
	 * @param array $data
	 * @return array $form
	 */
	
	public static function editPublisher($data)
	{
		$form = new Zend_Form();
		$form->setAction('edit');
		$form->setMethod('post');
		
		//add form elements
		$form->addElement('text','publisher',
					array('label' => 'Publisher',
						  'value' => $data['publisher']
						 )
					);
		$form->addElement('hidden', 'id', array('value' => $data['id']));
		$form->addElement('submit','save changes');
		return $form;
	}
	
	/**
	 * 
	 * Form search for publisher
	 * @param array $searchData
	 * @return array $form
	 */
	public static function searchPublisher()
	{
		$form = new Zend_Form();
		$form->setAction('search')
			 ->setMethod('post')
			 ->addElement('text','string',
			 			array('label' => 'search'))
			 ->addElement('hidden', 'status',
			 			array('value' => 1))
			 ->addElement('submit', 'search');
		return $form;
	}
	
	/**
	 * Form insert Publication
	 * 
	 */
	
	public static function insertPublication()
	{
		$form = new Zend_Form();
		$form->setAction('insert')
			 ->setMethod('post')
			 ->addElement('hidden', 'status',
			 	array('value' => 'insert'))	
			 ->addElement('text', 'publication',
			 	array('label' => 'Publication')
			 	)
			 ->addElement('submit', 'save');
	    return $form;
	}
	public static function updatePublication($publicationData, $publisherData, $currentPublisher)
	{	
		//set up select for publisher

	 	$publisher = new Zend_Form_Element_Select('publisher_id');
	 	$publisher->setLabel('select Publisher');
	 	if('' != $currentPublisher) {
 			$publisher->addMultiOption($currentPublisher[0],$currentPublisher[1]);
	 	}
	 	$publisher->addMultiOptions($publisherData);
	    //display current value if set
	 		

	 	
	 	//set up select for authors micha
		$optionAuthors = array(
			'label' => 'Author',
			'multioptions' => array( 1 => 'Auth1', 2 => 'Auth2')
			);
		$authors = new Zend_Form_Element_Select('authors', $optionAuthors);
	  
		$form = new Zend_Form();
		$form->setAction('update')
			 ->setMethod('post')
			 ->addElement('hidden', 'status',
			 	array('value' => 'update'))
			 ->addElement('hidden', 'id',
			 	array('value' => $publicationData['id']))
			 ->addElement('text', 'publication',
			 	array('label' => 'Publication',
			 		  'value' => $publicationData['publication'])
			 	)
			 ->addElement($publisher)
			 ->addElement($authors)		 	
			 ->addElement('submit', 'save');
		return $form;
	}
}

?>