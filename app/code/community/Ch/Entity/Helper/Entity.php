<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Helper_Entity extends Ch_Entity_Helper_Data
{
    /**
     * @param Ch_Entity_Model_Entity $entity
     * @param Mage_Eav_Model_Entity_Attribute $attribute
     * @return string
     */
    public function getAttributeValue(Ch_Entity_Model_Entity $entity, Mage_Eav_Model_Entity_Attribute $attribute)
    {
        if ('multiselect' == $attribute->getFrontendInput()) {
            $values = explode(',', $entity->getData($attribute->getAttributeCode()));
            $result = array();
            foreach ($values as $value) {
                $result[] = $attribute->getSource()->getOptionText($value);
            }
            $result = implode(', ', $result);
        } elseif('select' == $attribute->getFrontendInput() || 'boolean' == $attribute->getFrontendInput()) {
            $result = $attribute->getSource()->getOptionText($entity->getData($attribute->getAttributeCode()));
        } else {
            $result = $entity->getData($attribute->getAttributeCode());
        }
        return $result;
    }
}
