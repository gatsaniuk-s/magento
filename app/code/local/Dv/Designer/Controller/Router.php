<?php

/**
 * Designer Controller Router
 *
 */
class Dv_Designer_Controller_Router extends Mage_Core_Controller_Varien_Router_Standard
{

    /**
     * Match the request
     *
     * @param Zend_Controller_Request_Http $request
     * @return bool
     */
    public function match(Zend_Controller_Request_Http $request)
    {
        $url = trim($request->getOriginalPathInfo(), '/');

        if (strpos($url, 'designer/') !== false) {
            /** @var Dv_Designer_Model_Designer $designer */
            $urlKey = str_replace('designer/', '', $url);
            $designer = Mage::getModel('dv_designer/designer');
            $designer->load($urlKey, 'url_key');

            if ($designer->getId()) {
                Mage::register('current_designer', $designer);
                $request->setModuleName('designer')
                    ->setControllerName('index')
                    ->setActionName('view')
                    ->setParam('url', $urlKey);
                return true;
            }
        }
        return false;
    }
}
