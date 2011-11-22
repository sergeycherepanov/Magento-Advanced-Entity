<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

/**
 * Entity entity model
 *
 * @method string getEntityTypeCode()
 */
class Ch_Entity_Model_Entity extends Mage_Core_Model_Abstract
{
    /** @var string */
    protected $_eventPrefix = 'advanced_entity';
    /** @var array */
    protected $_attributes;

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ch_entity/entity');
    }

    /**
     * Get resource instance
     *
     * @return Mage_Core_Model_Mysql4_Abstract
     */
    protected function _getResource()
    {
        if (empty($this->_resourceName)) {
            Mage::throwException(Mage::helper('core')->__('Resource is not set.'));
        }

        return Mage::getResourceSingleton(
            $this->_resourceName,
            array('entity_type_code' => $this->getEntityTypeCode()));
    }

    /**
     * Retrieve all attributes
     *
     * @return array
     */
    public function getAttributes()
    {
        if ($this->_attributes === null) {
            /** @var $resource Ch_Entity_Model_Resource_Entity */
            $resource = $this->_getResource();
            $resource->loadAllAttributes($this);
            $this->_attributes = $resource->getSortedAttributes();
        }
        return $this->_attributes;
    }

    /**
     * Prepare data for save
     *
     * @param array $data
     * @return array
     */
    public function filterData($data)
    {
        $availableFields = array();
        /** @var $attribute Mage_Eav_Model_Entity_Attribute */
        foreach ($this->getAttributes() as $attribute) {
            if ($attribute->getData('is_user_defined')) {
                $availableFields[] = $attribute->getAttributeCode();
            }
        }
        foreach ($data as $key => $value) {
            if (!in_array($key, $availableFields)) {
                unset ($data[$key]);
            }
        }
        return $data;
    }
}
