<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 * @method Ch_Entity_Block_Adminhtml_Helper_Form_Boolean setValues(array $values)
 */
class Ch_Entity_Block_Adminhtml_Helper_Form_Boolean extends Varien_Data_Form_Element_Select
{
    /**
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $helper = Mage::helper('ch_entity');
        $this->setValues(array(
            array(
                'label' => $helper->__('No'),
                'value' => 0,
            ),
            array(
                'label' => $helper->__('Yes'),
                'value' => 1,
            ),
        ));
    }
}
