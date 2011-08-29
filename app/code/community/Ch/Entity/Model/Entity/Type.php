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
    /** @var Ch_Entity_Helper_Data */
    protected $_helper;

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

    public function getEntityModel($entityTypeCode = null)
    {
        if (!$entityTypeCode) {
            $entityTypeCode = $this->getEntityTypeCode();
        }
        if (!$entityTypeCode) {
            Mage::throwException($this->_helper->__('Entity type not defined.'));
        }
        /** @var $entityModel Ch_Entity_Model_Entity */
        $entityModel = Mage::getModel('ch_entity/entity', array('entity_type_code' => $entityTypeCode));
        return $entityModel;
    }
}

