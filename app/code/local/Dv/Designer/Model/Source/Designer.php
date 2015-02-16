<?php

class Dv_Designer_Model_Source_Designer extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        $designerCollection = Mage::getModel('dv_designer/designer')->getCollection()
            ->setOrder('name', Varien_Db_Select::SQL_ASC);
        $options = array(
            array(
                'label' => '',
                'value' => '',
            ),
        );
        foreach ($designerCollection as $_designer) {
            $options[] = array(
                'label' => $_designer->getName(),
                'value' => $_designer->getId(),
            );
        }
        return $options;
    }
}
