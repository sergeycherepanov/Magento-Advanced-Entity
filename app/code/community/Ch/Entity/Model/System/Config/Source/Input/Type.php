<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Model_System_Config_Source_Input_Type
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $helper = Mage::helper('ch_entity');
        return array(
            array('value' => 'text',        'label' => $helper->__('Text Field')),
            array('value' => 'textarea',    'label' => $helper->__('Text Area')),
            array('value' => 'date',        'label' => $helper->__('Date')),
            array('value' => 'boolean',     'label' => $helper->__('Yes/No')),
            array('value' => 'multiselect', 'label' => $helper->__('Multiple Select')),
            array('value' => 'select',      'label' => $helper->__('Dropdown')),
            array('value' => 'image',       'label' => $helper->__('Image')),
        );
    }
}