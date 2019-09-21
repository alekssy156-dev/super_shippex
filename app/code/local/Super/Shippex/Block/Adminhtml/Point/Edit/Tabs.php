<?php

class Super_Shippex_Block_Adminhtml_Point_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('points_tab');
        $this->setDestElementId('edit_form');
        $this->setTitle('Pickup Point');
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => 'Details',
            'title' => 'Details',
            'content' => $this->getLayout()
                ->createBlock('shippex/adminhtml_point_edit_tab_form')
                ->toHtml()
        ));

        return parent::_beforeToHtml();
    }
}