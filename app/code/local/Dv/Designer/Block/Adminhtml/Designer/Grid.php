<?php

class Dv_Designer_Block_Adminhtml_Designer_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('dv_designer/designer')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl(
            'dv_designer/adminhtml_designer/edit',
            array(
                'id' => $row->getId()
            )
        );
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'entity_id',
        ));

        $this->addColumn('created_at', array(
            'header' => $this->_getHelper()->__('Created'),
            'type' => 'datetime',
            'index' => 'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header' => $this->_getHelper()->__('Updated'),
            'type' => 'datetime',
            'index' => 'updated_at',
        ));

        $this->addColumn('name', array(
            'header' => $this->_getHelper()->__('Name'),
            'type' => 'text',
            'index' => 'name',
        ));

        $this->addColumn('lastname', array(
            'header' => $this->_getHelper()->__('Url Key'),
            'type' => 'text',
            'index' => 'url_key',
        ));

        /** @var Dv_Designer_Model_Designer $designerSingleton */
        $designerSingleton = Mage::getSingleton('dv_designer/designer');
        $this->addColumn('visibility', array(
            'header' => $this->_getHelper()->__('Visibility'),
            'type' => 'options',
            'index' => 'visibility',
            'options' => $designerSingleton->getAvailableVisibilities()
        ));

        $this->addColumn('action', array(
            'header' => $this->_getHelper()->__('Action'),
            'width' => '50px',
            'type' => 'action',
            'actions' => array(
                array(
                    'caption' => $this->_getHelper()->__('Edit'),
                    'url' => array(
                        'base' => 'dv_designer/adminhtml_designer/edit',
                    ),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'entity_id',
        ));

        return parent::_prepareColumns();
    }

    protected function _getHelper()
    {
        return Mage::helper('dv_designer');
    }
}
