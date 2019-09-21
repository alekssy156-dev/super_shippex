<?php

class Super_Shippex_Block_Adminhtml_Point_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'shippex';
        $this->_controller = 'adminhtml_point';
        $this->_updateButton('save', 'label', 'Save pickup point');
        $this->_updateButton('delete', 'label', 'Delete pickup point');
    }

    public function getHeaderText()
    {
        if (Mage::registry('point_data') && Mage::registry('point_data')->getId()) {
            return 'Edit Pickup Point ' . $this->htmlEscape(Mage::registry('point_data')->getTitle());
        } else {
            return 'Add Pickup Point';
        }
    }
}
