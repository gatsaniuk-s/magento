<?php

class Dv_Designer_Block_List extends Mage_Core_Block_Template
{
    public function getDesigners()
    {
        /** @var Dv_Designer_Model_Resource_Designer_Collection $collection */
        $collection = Mage::getModel('dv_designer/designer')->getCollection();
        $collection->addFieldToFilter('visibility', Dv_Designer_Model_Designer::VISIBILITY_VISIBLE)
            ->setOrder('name', Varien_Db_Select::SQL_ASC);
        return $collection->getItems();
    }
}
