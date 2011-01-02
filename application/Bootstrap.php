<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Bootstrap autoloader for application resources
     * 
     * @return Zend_Application_Module_Autoloader
     */
    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'default',
            'basePath'  => 'dirname(__FILE__)',
        ));

        //
        return $autoloader;

    }
    
    
    protected function _initDoctype()

    {

        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');

    }
    
    protected function _initSidebar()

    {

        $this->bootstrap('View');
        $view = $this->getResource('View');

        $view->placeholder('sidebar')

             // "prefix" -> markup to emit once before all items in collection

             ->setPrefix("<div id=\"sidebar\">\n    <div class=\"block\">\n")

             // "separator" -> markup to emit between items in a collection

             ->setSeparator("</div>\n    <div class=\"block\">\n")

             // "postfix" -> markup to emit once after all items in a collection

             ->setPostfix("</div>\n</div>");
    }
    

}

