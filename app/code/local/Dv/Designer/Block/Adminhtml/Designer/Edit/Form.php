<?php

class Dv_Designer_Block_Adminhtml_Designer_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'dv_designer/adminhtml_designer/edit',
                array(
                    '_current' => true,
                    'continue' => 0,
                )
            ),
            'method' => 'post',
        ));
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Designer Details')
            )
        );

        /**
         * @var $designerSingleton Dv_Designer_Model_Designer
         */
        $designerSingleton = Mage::getSingleton('dv_designer/designer');

        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label'    => $this->__('Name'),
                'input'    => 'text',
                'required' => true,
            ),
            'url_key' => array(
                'label'    => $this->__('URL Key'),
                'input'    => 'text',
                'required' => false,
                'disabled' => true,
                'readonly' => true,
                'style'    => "background-color: #E0D8E0",
            ),
            'description' => array(
                'label'    => $this->__('Description'),
                'input'    => 'textarea',
                'required' => true,
            ),
            'visibility' => array(
                'label'    => $this->__('Visibility'),
                'input'    => 'select',
                'required' => true,
                'options'  => $designerSingleton->getAvailableVisibilities(),
            )
        ));

        return $this;
    }

    /**
     * @param Varien_Data_Form_Element_Fieldset $fieldset
     * @param $fields
     * @return $this
     * @throws Exception
     */
    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('designerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            $_data['name'] = "designerData[$name]";

            $_data['title'] = $_data['label'];

            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getDesigner()->getData($name);
            }

            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    protected function _getDesigner()
    {
        if (!$this->hasData('designer')) {
            // This will have been set in the controller.
            $designer = Mage::registry('current_designer');

            // Just in case the controller does not register the designer.
            if (!$designer instanceof Dv_Designer_Model_Designer) {
                $designer = Mage::getModel('dv_designer/designer');
            }
            $this->setData('designer', $designer);
        }

        return $this->getData('designer');
    }
}
