<?php

class Dv_Designer_Adminhtml_DesignerController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Instantiate our grid container block and add to the page content.
     * When accessing this admin index page, we will see a grid of all
     * designers currently available in our Magento instance, along with
     * a button to add a new one if we wish.
     */
    public function indexAction()
    {
        // instantiate the grid container
        $designerBlock = $this->getLayout()
            ->createBlock('dv_designer/adminhtml_designer');

        // Add the grid container as the only item on this page
        $this->loadLayout()
            ->_addContent($designerBlock)
            ->renderLayout();
    }

    /**
     * This action handles both viewing and editing existing designer.
     */
    public function editAction()
    {
        /**
         * Retrieve existing designer data if an ID was specified.
         * If not, we will have an empty designer entity ready to be populated.
         */
        $designer = Mage::getModel('dv_designer/designer');

        if ($designerId = $this->getRequest()->getParam('id', false)) {
            $designer->load($designerId);

            if (!$designer->getId()) {
                $this->_getSession()->addError($this->__('This designer no longer exists.'));
                return $this->_redirect(
                    'dv_designer/adminhtml_designer/index'
                );
            }
        }

        // process $_POST data if the form was submitted
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

            /**
             * If we get to here, then something went wrong. Continue to
             * render the page as before, the difference this time being
             * that the submitted $_POST data is available.
             */
        }

        // Make the current designer object available to blocks.
        Mage::register('current_designer', $designer);

        // Instantiate the form container.
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

        if ($designerId = $this->getRequest()->getParam('id', false)) {
            $designer->load($designerId);
        }

        if (!$designer->getId()) {
            $this->_getSession()->addError($this->__('This designer no longer exists.'));
            return $this->_redirect(
                'dv_designer/adminhtml_designer/index'
            );
        }

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

    /**
     * Thanks to Ben for pointing out this method was missing. Without
     * this method the ACL rules configured in adminhtml.xml are ignored.
     */
    protected function _isAllowed()
    {
        /**
         * we include this switch to demonstrate that you can add action
         * level restrictions in your ACL rules. The isAllowed() method will
         * use the ACL rule we have configured in our adminhtml.xml file:
         * - acl
         * - - resources
         * - - - admin
         * - - - - children
         * - - - - - dv_disignerdirectory
         * - - - - - - children
         * - - - - - - - designer
         *
         * eg. you could add more rules inside designer for edit and delete.
         */
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('dv_designer/designer');
                break;
        }

        return $isAllowed;
    }
}
