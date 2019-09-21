<?php

use Super_Shippex_Model_Carrier_Abstract as AbstractCarrier;
use Super_Shippex_Model_Point as PointModel;
use Super_Shippex_Model_Resource_Point_Collection as PointCollection;

/**
 * Class Super_Shippex_Model_Carrier_Pickup
 */
class Super_Shippex_Model_Carrier_Point extends AbstractCarrier implements Mage_Shipping_Model_Carrier_Interface
{
    const CODE = 'shippex_point';

    /**
     * Carrier's code
     *
     * @var string
     */
    protected $_code = 'shippex_point';

    /**
     * Whether this carrier has fixed rates calculation
     *
     * @var bool
     */
    protected $_isFixed = true;

    /**
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return bool|false|Mage_Core_Model_Abstract|Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        $result = Mage::getModel('shipping/rate_result');

        $this->_updateFreeMethodQuote($request);

        $method = Mage::getModel('shipping/rate_result_method');

        $method->setCarrier(self::CODE);
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod(self::CODE);
        $method->setMethodTitle($this->getConfigData('name'));

        $shippingPrice = $this->getFinalPriceWithHandlingFee(
            $this->getConfigData('price')
        );

        if ($request->getFreeShipping() === true) {
            $shippingPrice = '0.00';
        }

        $method->setPrice($shippingPrice);
        $method->setCost($shippingPrice);

        $result->append($method);

        return $result;
    }

    /**
     * @return bool|Mage_Core_Model_Abstract|Super_Shippex_Model_Carrier_Abstract
     */
    public function checkAvailableShipCountries()
    {
        $showMethod = $this->getConfigData('showmethod');
        if ($showMethod && empty($this->getOptions())) {
            $error = Mage::getModel('shipping/rate_result_error');
            $error->setCarrier($this->_code);
            $error->setCarrierTitle($this->getConfigData('title'));
            $errorMsg = $this->getConfigData('specificerrmsg');
            $error->setErrorMessage($errorMsg);
            return $error;
        }
        if (!$showMethod && empty($this->getOptions())) {
            return false;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getAllowedMethods()
    {
        return array();
    }

    /**
     * @return array
     */
    protected function _getOptionsArray()
    {
        $result = [];
        /** @var PointCollection $pointCollection */
        $pointCollection = Mage::getResourceModel('shippex/point_collection');
        /** @var PointModel $point */
        foreach ($pointCollection->getItems() as $point) {
            $result[$point->getId()] = $point->getShippingDescription();
        }
        return $result;
    }
}
