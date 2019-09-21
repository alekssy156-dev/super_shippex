<?php

use Mage_Core_Controller_Request_Http as RequestHttp;
use Mage_Sales_Model_Quote as QuoteModel;
use Super_Shippex_Model_Point as PointModel;

/**
 * Class Super_Shippex_Model_Observer
 */
class Super_Shippex_Model_Observer
{
    private $storage = [];

    /**
     * @param Varien_Event_Observer $observer
     */
    public function beforeSaveShippingMethod(Varien_Event_Observer $observer)
    {
        /** @var RequestHttp $request */
        $request = $observer->getRequest();
        /** @var QuoteModel $quote */
        $quote = $observer->getQuote();
        $post = $request->getPost();
        $method = isset($post['shipping_method']) ? $post['shipping_method'] : false;
        if ($method) {
            $field = "{$method}_options";
            if (isset($post[$field])) {
                if ($model = PointModel::get($post[$field])) {
                    $quote->getShippingAddress()->setShippingDescription($model->getShippingDescription());
                }
            }
        }
    }

    public function beforeCollectTotals(Varien_Event_Observer $observer)
    {
        /** @var QuoteModel $quote */
        $quote = $observer->getQuote();
        $this->_handleDescription(
            $quote,
            $quote->getShippingAddress()->getShippingDescription()
        );
    }

    /**
     * @param Varien_Event_Observer $observer
     */
    public function afterCollectTotals(Varien_Event_Observer $observer)
    {
        /** @var QuoteModel $quote */
        $quote = $observer->getQuote();
        if ($description = $this->_handleDescription($quote)) {
            $quote->getShippingAddress()->setShippingDescription($description);
        }
    }

    /**
     * @param Mage_Sales_Model_Quote $quote
     * @param null $value
     * @return bool|mixed
     */
    private function _handleDescription(QuoteModel $quote, $value = null)
    {
        $key = $this->_getKey($quote);
        if ($value) {
            $this->storage[$key] = $value;
        } else {
            $result = isset($this->storage[$key]) ? $this->storage[$key] : false;
            unset($this->storage[$key]);
            return $result;
        }
    }

    /**
     * @param Mage_Sales_Model_Quote $quote
     * @return string
     */
    private function _getKey(QuoteModel $quote)
    {
        return $quote->getId() . '_' . $quote->getShippingAddress()->getId();
    }

}