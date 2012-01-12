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
    /** @var Ch_Entity_Helper_Entity */
    protected $_helper;
    /** @var Ch_Entity_Model_Entity_Type */
    protected $_entityTypeModel;
    /** @var string */
    protected $_entityTypeCode;

    /**
     * @return Ch_Entity_Block_List
     */
    protected function _beforeToHtml()
    {
        parent::_beforeToHtml();
        /** @var $pager Mage_Page_Block_Html_Pager */
        $pager = $this->getChild('pager');
        if ($pager) {
            $pager->setCollection($this->getEntityCollection());
        }
        return $this;
    }

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
    public function getEntityTypeModel()
    {
        if (is_null($this->_entityTypeModel)) {
            if ($this->_entityTypeCode) {
                /** @var $entityTypeModel Ch_Entity_Model_Entity_Type */
                $entityTypeModel = Mage::getModel('ch_entity/entity_type');
                $entityTypeModel->setEntityTypeCode($this->_entityTypeCode);
                $this->setEntityTypeModel($entityTypeModel);
            } else {
                Mage::throwException($this->_getHelper()->__('Entity type model is not defined.'));
            }
        }
        return $this->_entityTypeModel;
    }

    /**
     * @param Ch_Entity_Model_Entity_Type $model
     * @return Ch_Entity_Block_List
     */
    public function setEntityTypeModel(Ch_Entity_Model_Entity_Type $model)
    {
        $this->_entityTypeModel = $model;
        $this->_entityTypeCode  = $model->getEntityTypeCode();
        return $this;
    }

    /**
     * @return string
     */
    public function getEntityTypeCode()
    {
        return $this->_entityTypeCode;
    }

    /**
     * @param $code
     * @return Ch_Entity_Block_List
     */
    public function setEntityTypeCode($code)
    {
        $this->_entityTypeCode = $code;
        unset($this->_entityTypeModel);
        return $this;
    }

    /**
     * @return Ch_Entity_Model_Resource_Entity_Collection
     */
    public function getEntityCollection()
    {
        if (is_null($this->_collection)) {
            $this->_collection = $this->getEntityTypeModel()->getEntityModel()->getResourceCollection();
            $this->_collection->addAttributeToSelect('*');
        }
        return $this->_collection;
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
     * @param Ch_Entity_Model_Entity $entity
     * @return string
     */
    public function getEntityUrl(Ch_Entity_Model_Entity $entity)
    {
        return $this->_getHelper()->getUrlModel()->getUrl(
            null,
            array(
                '_entity_code' => $this->getEntityTypeModel()->getEntityTypeCode(),
                '_entity_id'   => $entity->getId(),
            )
        );  
    }
}
