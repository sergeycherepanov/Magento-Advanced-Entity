<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Entity_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form   = new Varien_Data_Form();
        /** @var $entityTypeModel Ch_Entity_Model_Entity_Type */
        $entityTypeModel = Mage::registry('entity_type');
        $editMode = $entityTypeModel && $entityTypeModel->getId() ? true : false;

        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'main_fieldset',
            array('legend' => $this->__('Entity information'))
        );

        $fieldset->addField('entity_type_name', 'text', array(
            'name'      => 'entity_type_name',
            'label'     => $this->__('Name'),
            'title'     => $this->__('Name'),
            'required'  => true,
        ));

        if ($editMode) {
            $fieldset->addField('entity_type_code', 'text', array(
                'name'      => 'entity_type_code',
                'label'     => $this->__('Code'),
                'title'     => $this->__('Code'),
                'required'  => true,
                'readonly'  => true,
                'style'     => 'background:#eee;color:#666;'
            ));
        } else {
            $fieldset->addField('entity_type_code', 'text', array(
                'name'      => 'entity_type_code',
                'label'     => $this->__('Code'),
                'title'     => $this->__('Code'),
                'required'  => true,
            ));
        }



        if ($entityTypeModel) {
            $form->setValues($entityTypeModel->getData());
        }

        return parent::_prepareForm();
    }


}
