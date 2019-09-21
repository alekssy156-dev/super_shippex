<?php

use Super_Shippex_Model_Resource_Point as PointResource;

class Super_Shippex_Block_Adminhtml_Point_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('id');
        $this->setId('shippex_point_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('shippex/point_collection');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->_addGridColumn(PointResource::FIELD_ID);
        $this->_addGridColumn(PointResource::FIELD_NAME);
        $this->_addGridColumn(PointResource::FIELD_CODE);
        $this->_addGridColumn(PointResource::FIELD_STREET);
        $this->_addGridColumn(PointResource::FIELD_NUMBER);
        $this->_addGridColumn(PointResource::FIELD_CITY);
        $this->_addGridColumn(PointResource::FIELD_POSTCODE);

        return parent::_prepareColumns();
    }

    /**
     * @param $field_code
     * @throws Exception
     */
    private function _addGridColumn($field_code)
    {
        $this->addColumn($field_code,
            array(
                'header' => $this->__(strtoupper($field_code)),
                'align' => 'right',
                'width' => '50px',
                'index' => $field_code
            )
        );
    }
}