<?php
class Dv_Designer_Model_Resource_Designer extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        /**
         * Tell Magento the database name and primary key field to persist
         * data to. Similar to the _construct() of our model, Magento finds
         * this data from config.xml by finding the <resourceModel/> node
         * and locating children of <entities/>.
         *
         * In this example:
         * - sdv_designer is the model alias
         * - designer is the entity referenced in config.xml
         * - entity_id is the name of the primary key column
         *
         * As a result, Magento will write data to the table
         * 'dv_designer_designer' and any calls
         * to $model->getId() will retrieve the data from the
         * column named 'entity_id'.
         */
        $this->_init('dv_designer/designer', 'entity_id');
    }
}
