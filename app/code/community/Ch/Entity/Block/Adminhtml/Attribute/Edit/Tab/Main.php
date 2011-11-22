<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Attribute_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
{
    /** @var Ch_Entity_Helper_Data */
    protected $_helper;
    /** @var Ch_Entity_Model_Entity_Attribute */
    protected $_attribute;
    protected $_isEditMode = false;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_helper    = Mage::helper('ch_entity');
        $this->_attribute = Mage::registry('entity_attribute');
        if (!$this->_attribute) {
            $this->_attribute = new Varien_Object();
        }
        if ($this->_attribute->getId() > 0) {
            $this->_isEditMode = true;
        }
        parent::_construct();
    }

    /**
     * Initialize form fields
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form        = new Varien_Data_Form();
        $attribute   = $this->_attribute;
        $isEditMode  = $this->_isEditMode;

        if (!$isEditMode) {
            $attribute->setEntityTypeId($this->getRequest()->getParam('entity_type'));
        }

        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'main_fieldset',
            array('legend' => $this->__('Attribute information'))
        );

        $fieldset->addField('entity_type_id', 'hidden', array(
            'name'      => 'entity_type_id'
        ));
        if ($isEditMode) {
            $fieldset->addField('attribute_id', 'hidden', array(
                'name'      => 'attribute_id'
            ));
        }

        if ($isEditMode) {
            $fieldset->addField('attribute_code', 'text', array(
                'name'      => 'attribute_code',
                'label'     => $this->__('Attribute Code'),
                'title'     => $this->__('Attribute Code'),
                'required'  => true,
                'readonly'  => true,
                'style'     => 'background:#eee;color:#666;'
            ));
        } else {
            $fieldset->addField('attribute_code', 'text', array(
                'name'      => 'attribute_code',
                'label'     => $this->__('Attribute Code'),
                'title'     => $this->__('Attribute Code'),
                'required'  => true,
            ));
        }

        /** @var $inputTypes Mage_Eav_Model_Adminhtml_System_Config_Source_Inputtype */
        $inputTypes = Mage::getModel('eav/adminhtml_system_config_source_inputtype');
        $inputTypesArray = array();

        foreach ($inputTypes->toOptionArray() as $type) {
            $inputTypesArray[$type['value']] = $type['label'];
        }

        $fieldset->addField('frontend_input', 'select', array(
            'name'      => 'frontend_input',
            'label'     => $this->__('Frontend Input'),
            'title'     => $this->__('Frontend Input'),
            'required'  => true,
            'value'     => 'text',
            'options'   => $inputTypesArray,
        ));

        $form->setValues($attribute->getData());

        return parent::_prepareForm();
    }
}
