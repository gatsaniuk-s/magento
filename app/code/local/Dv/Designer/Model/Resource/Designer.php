<?php

class Dv_Designer_Model_Resource_Designer extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('dv_designer/designer', 'entity_id');
    }
}
