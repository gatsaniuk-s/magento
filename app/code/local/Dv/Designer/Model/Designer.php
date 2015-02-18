<?php

/**
 * Class Dv_Designer_Model_Designer
 *
 * @method string getName()
 * @method Dv_Designer_Model_Designer setName(string $name)
 * @method string getUrlKey()
 * @method Dv_Designer_Model_Designer setUrlKey(string $urlKey)
 * @method string getDescription()
 * @method Dv_Designer_Model_Designer setDescription(string $description)
 * @method datetime getUpdatedAt()
 * @method Dv_Designer_Model_Designer setUpdatedAt(datetime $updateAt)
 */
class Dv_Designer_Model_Designer extends Mage_Core_Model_Abstract
{
    const VISIBILITY_HIDDEN  = '0';
    const VISIBILITY_VISIBLE = '1';

    protected function _construct()
    {
        $this->_init('dv_designer/designer');
    }

    /**
     * @return array
     */
    public function getAvailableVisibilities()
    {
        return array(
            self::VISIBILITY_HIDDEN  => Mage::helper('dv_designer')->__('Hidden'),
            self::VISIBILITY_VISIBLE => Mage::helper('dv_designer')->__('Visible'),
        );
    }

    /**
     * @return $this
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $this->_prepareUrlKey();
        $this->setUpdatedAt(Varien_Date::now());
        return $this;
    }

    /**
     * @return $this
     */
    protected function _prepareUrlKey()
    {
        $name = trim(strtolower($this->getName()));

        $urlKey = preg_replace('/\s+/', '-', $name);
        $urlKey = preg_replace('/[^a-z0-9 -]/i', '', $urlKey);

        $this->setUrlKey($urlKey);

        return $this;
    }

    /**
     * @return string
     */
    public function getDesignerUrl()
    {
        return  Mage::getUrl('designer/' . $this->getUrlKey());
    }
}
