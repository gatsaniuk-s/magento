<?php

class Dv_Designer_Block_Adminhtml_Designer_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        // Instantiate a new form to display our designer for editing.
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

        // Define a new fieldset. We need only one for our simple entity.
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

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
            'url_key' => array(
                'label' => $this->__('URL Key'),
                'input' => 'text',
                'required' => true,
            ),
            'description' => array(
                'label' => $this->__('Description'),
                'input' => 'textarea',
                'required' => true,
            ),
            'visibility' => array(
                'label' => $this->__('Visibility'),
                'input' => 'select',
                'required' => true,
                'options' => $designerSingleton->getAvailableVisibilies(),
            ),

            /**
             * Note: we have not included created_at or updated_at.
             * We will handle those fields ourself in the model
             * before saving.
             */
        ));

        return $this;
    }

    /**
     * This method makes life a little easier for us by pre-populating
     * fields with $_POST data where applicable and wrapping our post data
     * in 'designerData' so that we can easily separate all relevant information
     * in the controller. You could of course omit this method entirely
     * and call the $fieldset->addField() method directly.
     */
    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()
            ->getPost('designerData'));

        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with designerData group.
            $_data['name'] = "designerData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing designer data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getDesigner()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing designer for pre-populating the form fields.
     * For a new designer entry, this will return an empty designer object.
     */
    protected function _getDesigner()
    {
        if (!$this->hasData('designer')) {
            // This will have been set in the controller.
            $designer = Mage::registry('current_designer');

            // Just in case the controller does not register the designer.
            if (!$designer instanceof Dv_Designer_Model_Designer) {
                $designer = Mage::getModel(
                    'dv_designer/designer'
                );
            }

            $this->setData('designer', $designer);
        }

        return $this->getData('designer');
    }
}
