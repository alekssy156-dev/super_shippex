<?php

/**
 * Class Super_Shippex_Model_AbstractCarrier
 */
abstract class Super_Shippex_Model_Carrier_Abstract extends Mage_Shipping_Model_Carrier_Abstract
{
    /**
     * @var null|array
     */
    private $setCache = null;

    private $optionsCache = null;

    /**
     * @return array
     */
    abstract protected function _getOptionsArray();

    public function getCarrierOptions()
    {

    }

    /**
     * @return array|bool|null
     */
    public function getOptions()
    {
        if (is_null($this->optionsCache)) {
            $this->optionsCache = (array)$this->_getOptionsArray();
        }

        if (empty($this->optionsCache)) {
            return false;
        }

        if (is_null($this->setCache)) {
            $this->setCache = [0 => '-'] + $this->optionsCache;
        }

        return $this->setCache;
    }
}