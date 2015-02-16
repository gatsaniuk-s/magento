<?php

class Dv_Designer_Block_List extends Mage_Core_Block_Template
{
    public function getDesigners()
    {
        $collection = Mage::getModel('dv_designer/designer')->getCollection()
        ->addFieldToFilter('visibility', Dv_Designer_Model_Designer::VISIBILITY_DIRECTORY)
        ->setOrder('name', 'ASC');
        return $collection->getItems();
    }
}
