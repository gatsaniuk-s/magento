<?php
class Dv_Designer_Helper_Designer extends Mage_Core_Helper_Abstract
{
    public function getDesignerUrl(Dv_Designer_Model_Designer $designer)
    {
        if (!$designer instanceof Dv_Designer_Model_Designer) {
            return '#';
        }
        return $this->_getUrl(
            'dv_designer/view',
            array(
                'url' => $designer->getUrlKey(),
            )
        );
    }
}
