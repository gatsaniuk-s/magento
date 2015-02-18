<?php

class Dv_Designer_Adminhtml_DesignerController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $designerBlock = $this->getLayout()
            ->createBlock('dv_designer/adminhtml_designer');

        $this->loadLayout()
            ->_addContent($designerBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $designer = Mage::getModel('dv_designer/designer');

        if ($designerId = $this->getRequest()->getParam('id')) {
            $designer->load($designerId);

            if (!$designer->getId()) {
                $this->_getSession()->addError($this->__('This designer no longer exists.'));
                return $this->_redirect('dv_designer/adminhtml_designer/index');
            }
        }

        if ($postData = $this->getRequest()->getPost('designerData')) {
            try {
                $designer->addData($postData);
                $designer->save();

                $this->_getSession()->addSuccess(
                    $this->__('The designer has been saved.')
                );

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'dv_designer/adminhtml_designer/edit',
                    array('id' => $designer->getId())
                );
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
        }

        Mage::register('current_designer', $designer);

        $designerEditBlock = $this->getLayout()->createBlock(
            'dv_designer/adminhtml_designer_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($designerEditBlock)
            ->renderLayout();
    }

    public function deleteAction()
    {
        $designer = Mage::getModel('dv_designer/designer');
        $designer->setId($this->getRequest()->getParam('id', false));

        try {
            $designer->delete();

            $this->_getSession()->addSuccess(
                $this->__('The designer has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'dv_designer/adminhtml_designer/index'
        );
    }
}
