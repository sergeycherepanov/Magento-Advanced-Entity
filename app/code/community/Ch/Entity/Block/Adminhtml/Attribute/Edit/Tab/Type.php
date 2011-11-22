<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Attribute_Edit_Tab_Type
        extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        $action = 'setLocation((new Template(\''
                  . $this->getContinueUrl()
                  . '\', /(^|.|\r|\n)({{(\w+)}})/)).evaluate({entity_type:$F(\'entity_type\')}))';

        $block = $this->getLayout()->createBlock('adminhtml/widget_button');
        $block->setData(array(
                'label'     => $this->__('Continue'),
                'onclick'   => $action,
                'class'     => 'save'
                ));
        $this->setChild('continue_button', $block);
        return parent::_prepareLayout();
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form      = new Varien_Data_Form();
        $attribute = new Varien_Object();

        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'main_fieldset',
            array('legend' => $this->__('Attribute information'))
        );

        /** @var $collection Ch_Entity_Model_Resource_Entity_Type_Collection */
        $collection  = Mage::getResourceModel('ch_entity/entity_type_collection');
        $entityTypes = array();

        /** @var $entityType Ch_Entity_Model_Entity_Type */
        foreach ($collection as $entityType) {
            $entityTypes[$entityType->getEntityTypeId()] = $entityType->getEntityTypeName();
        }

        $fieldset->addField('entity_type', 'select', array(
            'name'      => 'entity_type',
            'label'     => $this->__('Entity Type'),
            'title'     => $this->__('Entity Type'),
            'required'  => true,
            'options'   => $entityTypes,
        ));

        $fieldset->addField('continue_button', 'note', array(
            'text' => $this->getChildHtml('continue_button'),
        ));

        $form->setValues($attribute->getData());
        return parent::_prepareForm();
    }

    /**
     * Continue button url
     *
     * @return string
     */
    public function getContinueUrl()
    {
        return $this->getUrl('*/*/new', array(
            '_current'    => true,
            'entity_type' => '{{entity_type}}'
        ));
    }
}
