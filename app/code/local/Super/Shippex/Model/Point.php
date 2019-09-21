<?php

use Super_Shippex_Model_Resource_Point as Resource;

/**
 * Class Super_Shippex_Model_Point
 */
class Super_Shippex_Model_Point extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('shippex/point');
    }

    /**
     * @return string
     */
    public function getShippingDescription()
    {
        return implode("\n", [
            $this->getName() . " - " . $this->getCode(),
            $this->getStreet() . " - " . $this->getNumber(),
            $this->getPostcode() . " - " . $this->getCity(),
        ]);
    }

    public function getId()
    {
        return $this->getData(Resource::FIELD_ID);
    }

    public function getName()
    {
        return $this->getData(Resource::FIELD_NAME);
    }

    public function getCode()
    {
        return $this->getData(Resource::FIELD_CODE);
    }

    public function getStreet()
    {
        return $this->getData(Resource::FIELD_STREET);
    }

    public function getNumber()
    {
        return $this->getData(Resource::FIELD_NUMBER);
    }

    public function getCity()
    {
        return $this->getData(Resource::FIELD_CITY);
    }

    public function getPostcode()
    {
        return $this->getData(Resource::FIELD_POSTCODE);
    }

    /**
     * @param bool $id
     * @return false|Mage_Core_Model_Abstract|static
     */
    public static function get($id = false)
    {
        $model = Mage::getModel(self::class);
        if ($id) {
            $model->load($id);
        }
        return $model;
    }
}