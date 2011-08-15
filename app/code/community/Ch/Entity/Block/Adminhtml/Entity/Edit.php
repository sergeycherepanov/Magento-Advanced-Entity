<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Entity_Edit
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
        $this->_controller = 'adminhtml_entity';

        $this->_updateButton('save', 'label', $this->__('Save'));
        $this->_updateButton('delete', 'label', $this->__('Delete'));

        $entityModel = Mage::registry('entity');

        if($entityModel && $entityModel->getId() > 0){

            $this->_addButton('generate', array(
                'label'     => $this->__('Generate File'),
                'onclick'   => 'setLocation(\''.$this->getUrl('*/*/generate', array('id'=>$entityModel->getId())).'\')',
            ), -100);

            if($entityModel->getFtpActive()){

                $this->_addButton('upload', array(
                    'label'     => $this->__('Upload File'),
                    'onclick'   => 'setLocation(\''.$this->getUrl('*/*/upload', array('id'=>$entityModel->getId())).'\')',
                ), -100);

            }

        }

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

    public function getHeaderText(){

        if( Mage::registry('gomage_feed') && Mage::registry('gomage_feed')->getId() ) {
            return $this->__("Edit %s", $this->htmlEscape(Mage::registry('gomage_feed')->getName()));
        } else {
            return $this->__('Add Item');
        }
    }
}
