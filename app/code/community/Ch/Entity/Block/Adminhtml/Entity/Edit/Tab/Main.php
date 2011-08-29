<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Entity_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form   = new Varien_Data_Form();
        $entity = new Varien_Object();

        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'main_fieldset',
            array('legend' => $this->__('Entity information'))
        );

        $fieldset->addField('code', 'text', array(
            'name'      => 'code',
            'label'     => $this->__('Code'),
            'title'     => $this->__('Code'),
            'required'  => true,
        ));

        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => $this->__('Name'),
            'title'     => $this->__('Name'),
            'required'  => true,
        ));

        $form->setValues($entity->getData());

        return parent::_prepareForm();
    }


}
