<?php

/** @var Mage_Eav_Model_Entity_Setup $installer */
$installer = Mage::getModel('eav/entity_setup', 'dv_designer_setup');

$installer->startSetup();

// add a new product attribute to associate a designer to each product
$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'designer_id', array(
    'group'  => 'General',
    'label'  => 'Designer',
    'input'  => 'select',
    'source' => 'dv_designer/source_designer',
));

$installer->endSetup();
