<?php

class Super_Shippex_Block_Adminhtml_Point extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'shippex';
        $this->_controller = 'adminhtml_point';
        $this->_headerText = $this->__('Grid');
        $this->_addButtonLabel = 'Add a pickup point';

        parent::__construct();
    }
}