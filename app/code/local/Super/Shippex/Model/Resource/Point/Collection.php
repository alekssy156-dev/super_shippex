<?php

class Super_Shippex_Model_Resource_Point_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('shippex/point');
    }
}