<?php
class Dv_Designer_Block_Adminhtml_Designer extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        /**
         * The $_blockGroup property tells Magento which alias to use to
         * locate the blocks to be displayed in this grid container.
         * In our example, this corresponds to designer/Block/Adminhtml.
         */
        $this->_blockGroup = 'dv_designer';

        /**
         * $_controller is a slightly confusing name for this property.
         * This value, in fact, refers to the folder containing our
         * Grid.php and Edit.php - in our example,
         * designer/Block/Adminhtml/Designer. So, we'll use 'designer'.
         */
        $this->_controller = 'adminhtml_designer';

        /**
         * The title of the page in the admin panel.
         */
        $this->_headerText = Mage::helper('dv_designer')
            ->__('Designer Directory');
    }

    public function getCreateUrl()
    {
        /**
         * When the "Add" button is clicked, this is where the user should
         * be redirected to - in our example, the method editAction of
         * DesignerController.php in designer module.
         */
        return $this->getUrl(
            'dv_designer/adminhtml_designer/edit'
        );
    }
}
