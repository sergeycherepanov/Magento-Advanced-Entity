<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_View extends Mage_Core_Block_Template
{
    /** @var Ch_Entity_Model_Entity */
    protected $_entity;
    /** @var Ch_Entity_Helper_Entity */
    protected $_helper;

    /**
     * @return Ch_Entity_Helper_Entity
     */
    protected function _getHelper()
    {
        if (is_null($this->_helper)) {
            $this->_helper = Mage::helper('ch_entity/entity');
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
     * @return Ch_Entity_Model_Entity
     */
    public function getEntity()
    {
        if (is_null($this->_entity)) {
            $this->_entity = $this->getEntityType()->getEntityModel();;
            $this->_entity->load($this->getRequest()->getParam('entity_id'));
        }
        return $this->_entity;
    }

    /**
     * @param Ch_Entity_Model_Entity $entity
     * @param Mage_Eav_Model_Entity_Attribute $attribute
     * @return string
     */
    public function getAttributeValue(Ch_Entity_Model_Entity $entity, Mage_Eav_Model_Entity_Attribute $attribute)
    {
        return $this->_getHelper()->getAttributeValue($entity, $attribute);
    }

    /**
     * @return string
     */
    public function getListUrl()
    {
        return $this->_getHelper()->getUrlModel()->getUrl(
            null,
            array(
                '_entity_code' => $this->getEntityType()->getEntityTypeCode(),
            )
        );  
    }
}
