<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_List extends Mage_Core_Block_Template
{
    /** @var Ch_Entity_Model_Resource_Entity_Collection */
    protected $_collection;
    /** @var Ch_Entity_Helper_Data */
    protected $_helper;

    /**
     * @return Ch_Entity_Helper_Data
     */
    protected function _getHelper()
    {
        if (is_null($this->_helper)) {
            $this->_helper = Mage::helper('ch_entity');
        }
        return $this->_helper;
    }

    /**
     * @return Ch_Entity_Model_Entity_Type
     */
    public function getEntityType()
    {
        return Mage::registry('entity_type_model');
    }

    /**
     * @return Ch_Entity_Model_Resource_Entity_Collection
     */
    public function getEntityCollection()
    {
        if (is_null($this->_collection)) {
            $this->_collection = $this->getEntityType()->getEntityModel()->getResourceCollection();
            $this->_collection->addAttributeToSelect('*');
        }
        return $this->_collection;
    }

    /**
     * @param Ch_Entity_Model_Entity $entity
     * @return string
     */
    public function getEntityUrl(Ch_Entity_Model_Entity $entity)
    {
        return $this->_getHelper()->getUrlModel()->getUrl(
            null,
            array(
                '_entity_code' => $this->getEntityType()->getEntityTypeCode(),
                '_entity_id'   => $entity->getId(),
            )
        );  
    }
}
