<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Entity_Manage_Entity extends Mage_Adminhtml_Block_Widget_Grid_Container
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
     *  Initialize class prefixes and labels
     */
    public function __construct()
    {
        $entityType = $this->getEntityType();
        $this->_controller = 'adminhtml_entity_manage_entity';
        $this->_blockGroup = 'ch_entity';
        $this->_headerText = $entityType->getEntityTypeName();
        $this->_addButtonLabel = $this->__('Add New');
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getCreateUrl()
    {
        return $this->getUrl('*/*/new', array('type_id' => $this->getEntityType()->getId()));
    }
}
