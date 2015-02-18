<?php

class Dv_Designer_Model_Resource_Designer_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('dv_designer/designer');
    }
}
