<?php

class Dv_Designer_Block_View extends Mage_Core_Block_Template
{
    /**
     * @return null|Dv_Designer_Model_Designer
     */
    public function getCurrentDesigner()
    {
        return Mage::registry('current_designer');
    }

    /**
     * @return array|Dv_Designer_Model_Resource_Designer_Collection
     */
    public function getProductCollection()
    {
        /** @var Dv_Designer_Model_Designer $designer */
        if (!$designer = $this->getCurrentDesigner()) {
            return array();
        }
        return Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToFilter('designer_id', $designer->getId())
            ->addUrlRewrite()
            ->setOrder('name', Varien_Db_Select::SQL_ASC);
    }
}
