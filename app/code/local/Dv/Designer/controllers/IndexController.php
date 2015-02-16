<?php

class Dv_Designer_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout()->renderLayout();
    }

    public function viewAction()
    {
        $designer = Mage::getModel('dv_designer/designer');
        $urlKey = $this->getRequest()->getParam('url', '');
        if (strlen($urlKey) > 0) {
            $designer->load($urlKey, 'url_key');
        } else {
            $id = (int)$this->getRequest()->getParam('id', 0);
            $designer->load($id);
        }
        if ($designer->getId() < 1) {
            $this->_redirect('*/*/index');
        }
        Mage::register('current_designer', $designer);
        $this->loadLayout()->renderLayout();
    }
}
