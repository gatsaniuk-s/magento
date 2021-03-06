<?php

class Dv_Designer_Block_Catalog_Product_View_Link extends Mage_Core_Block_Template
{
    /**
     * @return bool|Dv_Designer_Model_Designer
     */
    public function getDesigner()
    {
        $product = Mage::registry('current_product');
        if (!$product instanceof Mage_Catalog_Model_Product) {
            return false;
        }
        $designerId = (int) $product->getDesignerId();
        $designer = Mage::getModel('dv_designer/designer')->load($designerId);
        return $designer->getId() ? $designer : false;
    }
}
