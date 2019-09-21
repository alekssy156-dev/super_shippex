<?php

use Super_Shippex_Model_Resource_Point as PointResource;
use Varien_Data_Form_Element_Fieldset as VarienFieldSet;

/**
 * Class Super_Shippex_Block_Adminhtml_Point_Edit_Tab_Form
 */
class Super_Shippex_Block_Adminhtml_Point_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('point_form',
            array('legend' => 'Details'));

        $this->_addTextField($fieldset, PointResource::FIELD_NAME);
        $this->_addTextField($fieldset, PointResource::FIELD_CODE);
        $this->_addTextField($fieldset, PointResource::FIELD_STREET);
        $this->_addTextField($fieldset, PointResource::FIELD_NUMBER);
        $this->_addTextField($fieldset, PointResource::FIELD_CITY);
        $this->_addTextField($fieldset, PointResource::FIELD_POSTCODE, 'required-entry validate-zip');

        if (Mage::registry('point_data')) {
            $form->setValues(Mage::registry('point_data')->getData());
        }

        return parent::_prepareForm();
    }

    /**
     * @param $fieldset
     * @param $field_code
     * @param string $class
     * @param bool $required
     */
    private function _addTextField(VarienFieldSet $fieldset, $field_code, $class = 'required-entry', $required = true)
    {
        $fieldData = [
            'label' => ucfirst($field_code),
            'class' => $class,
            'required' => $required,
            'name' => $field_code,
        ];
        $maxLength = PointResource::getFieldLength($field_code);
        if ($maxLength) {
            $fieldData['class'] .= " validate-length maximum-length-$maxLength";
            $fieldData['after_element_html'] = '<p><small>' . "Max length: $maxLength" . '</small></p>';
        }

        $fieldset->addField($field_code, 'text', $fieldData);
    }
}