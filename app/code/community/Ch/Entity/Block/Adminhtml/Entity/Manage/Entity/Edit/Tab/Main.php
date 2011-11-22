<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Entity_Manage_Entity_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{
    /** @var Ch_Entity_Model_Entity_Type */
    protected $_entityType;

    /**
     * @return Ch_Entity_Model_Entity_Type
     */
    public function getEntityType()
    {
        if (is_null($this->_entityType)) {
            $this->_entityType = Mage::registry('entity_type');
        }
        return $this->_entityType;
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form   = new Varien_Data_Form();
        /** @var $itemModel Ch_Entity_Model_Entity */
        $itemModel = Mage::registry('entity_model');
        $formData  = $itemModel->getData();
        $editMode  = $itemModel && $itemModel->getId() ? true : false;

        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'main_fieldset',
            array('legend' => $this->__('Item information'))
        );

        $additionalInputTypes = array(
            'boolean' => Mage::getConfig()->getBlockClassName('ch_entity/adminhtml_helper_form_boolean')
        );

        foreach ($additionalInputTypes as $type => $className) {
            $fieldset->addType($type, $className);
        }

        if ($editMode) {
            $fieldset->addField('entity_id', 'hidden', array(
                'name'      => 'entity_id',
            ));
        }

        $fieldset->addField('type_id', 'hidden', array(
            'name'      => 'type_id',
        ));

        $formData['type_id'] = $this->getEntityType()->getId();

        $attributes = $itemModel->getAttributes();
        /** @var $attribute Mage_Eav_Model_Entity_Attribute */
        foreach ($attributes as $attribute) {
            if ($attribute->getData('is_user_defined')) {
                $attributeCode  = $attribute->getAttributeCode();
                $attributeLabel = $attribute->getData('frontend_label');
                $inputType      = $attribute->getData('frontend_input');
                $element = $fieldset->addField($attributeCode, $inputType, array(
                    'name'      => $attributeCode,
                    'title'     => $attributeLabel,
                    'label'     => $attributeLabel,
                ));
                

                switch ($inputType) {
                    case 'select':
                        /** @var $source Mage_Eav_Model_Entity_Attribute_Source_Table */
                        $source = $attribute->getSource();
                        $element->setValues($source->getAllOptions(true, true));
                        break;
                    case 'multiselect':
                        /** @var $source Mage_Eav_Model_Entity_Attribute_Source_Table */
                        $source = $attribute->getSource();
                        $element->setValues($source->getAllOptions(false, true));
                        break;
                    case 'date':
                        $element->setImage($this->getSkinUrl('images/grid-cal.gif'));
                        $element->setFormat(
                            Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
                        );
                        break;
                }

            }
        }

        if ($formData) {
            $form->setValues($formData);
        }

        return parent::_prepareForm();
    }


}
