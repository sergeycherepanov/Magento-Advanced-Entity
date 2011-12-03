<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

/**
 * Entity type model
 * @method string getEntityTypeCode()
 * @method string getEntityTypeId()
 * @method string getEntityTypeName()
 */
class Ch_Entity_Model_Entity_Type extends Mage_Core_Model_Abstract
{
    const MAPPED_MODEL_PATH = 'global/models/ch_entity/mapped_type/';
    /** @var Ch_Entity_Helper_Data */
    protected $_helper;
    /** @var string */
    protected $_eventPrefix = 'advanced_entity_type';

    /**
     * Initialize resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_helper = Mage::helper('ch_entity');
        $this->_init('ch_entity/entity_type');
    }

    /**
     * @return Ch_Entity_Helper_Data
     */
    public function getHelper()
    {
        return $this->_helper;
    }

    public function getMappedEntityModel($entityTypeCode)
    {
        return (string) Mage::getConfig()->getNode(self::MAPPED_MODEL_PATH . $entityTypeCode);
    }

    /**
     * @param null $entityTypeCode
     * @return Ch_Entity_Model_Entity
     */
    public function getEntityModel($entityTypeCode = null)
    {
        if (!$entityTypeCode) {
            $entityTypeCode = $this->getEntityTypeCode();
        }
        if (!$entityTypeCode) {
            Mage::throwException($this->_helper->__('Entity type not defined.'));
        }

        $modelClass = $this->getMappedEntityModel($entityTypeCode);
        if (!$modelClass) {
            $modelClass = 'ch_entity/entity';
        }

        /** @var $entityModel Ch_Entity_Model_Entity */
        $entityModel = Mage::getModel($modelClass, array('entity_type_code' => $entityTypeCode));
        return $entityModel;
    }

    /**
     * @return Mage_Core_Model_Abstract
     */
    public function _beforeDelete()
    {
        /** @var $eavEntityType Mage_Eav_Model_Entity_Type */
        $eavEntityType = Mage::getModel('eav/entity_type');
        $eavEntityType->load($this->getEntityTypeId());
        $eavEntityType->delete();
        return parent::_beforeDelete();
    }
}

