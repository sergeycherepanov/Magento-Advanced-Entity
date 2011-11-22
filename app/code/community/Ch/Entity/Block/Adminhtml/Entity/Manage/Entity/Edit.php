<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Entity_Manage_Entity_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize form block and interface
     */
    public function __construct()
    {
        parent::__construct();

        $this->_objectId   = 'id';
        $this->_blockGroup = 'ch_entity';
        $this->_controller = 'adminhtml_entity_manage_entity';

        $backUrl = $this->getUrl('*/*/manage', array('type_id' => $this->getRequest()->getParam('type_id')));
        $this->_updateButton('back',
                             'onclick',
                             'setLocation(\'' . $backUrl . '\')');

        $this->_updateButton('save', 'label', $this->__('Save'));
        $this->_updateButton('delete', 'label', $this->__('Delete'));

        //$entityModel = Mage::registry('entity');

        $this->_addButton('saveandcontinue', array(
            'label'     => $this->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
}
