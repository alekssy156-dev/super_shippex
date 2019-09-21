<?php

use Mage_Core_Block_Abstract as BlockAbstract;
use Mage_Adminhtml_Block_Sales_Order_Create_Shipping_Method_Form as Form;

class Super_Shippex_Model_Adminhtml_Observer
{
    public function createShippingMethodBlockBefore(Varien_Event_Observer $observer)
    {
        /** @var BlockAbstract $block */
        $block = $observer->getBlock();
        if($block instanceof Form)
        {
            $block->setTemplate('shippex/sales/order/create/shipping/method/form.phtml');
        }
    }
}