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
}
