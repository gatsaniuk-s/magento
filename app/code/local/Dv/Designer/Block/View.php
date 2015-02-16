<?php

class Dv_Designer_Block_View extends Mage_Core_Block_Template
{
    public function getCurrentDesigner()
    {
        return Mage::registry('current_designer');
    }
    public function getProductCollection()
    {
        $designer = $this->getCurrentDesigner();
        if (!$designer) {
            return array();
        }
        return Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToFilter('designer_id', $designer->getId())
            ->setOrder('name', 'ASC');
    }
}
