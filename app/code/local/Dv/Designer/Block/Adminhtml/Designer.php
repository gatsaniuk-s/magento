<?php
class Dv_Designer_Block_Adminhtml_Designer extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'dv_designer';

        $this->_controller = 'adminhtml_designer';

        $this->_headerText = Mage::helper('dv_designer')
            ->__('Designer');
    }

    public function getCreateUrl()
    {
        return $this->getUrl('dv_designer/adminhtml_designer/edit');
    }
}
