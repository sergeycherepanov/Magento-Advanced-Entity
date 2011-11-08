<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Model_Resource_Entity_Attribute_Collection extends Mage_Eav_Model_Mysql4_Entity_Attribute_Collection
{
    protected function _beforeLoad()
    {
        /** @var $entityTypeCollection Ch_Entity_Model_Resource_Entity_Type_Collection */
        $entityTypeCollection = Mage::getResourceModel('ch_entity/entity_type_collection');
        $entityTypeCollection->addFieldToSelect('entity_type_id');
        $typeIds = $entityTypeCollection->getColumnValues('entity_type_id');
        $this->addFieldToFilter('entity_type_id', array('in' => $typeIds));
    }
}
