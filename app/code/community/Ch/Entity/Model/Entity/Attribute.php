<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

/**
 * @method string getFrontendInput()
 */
class Ch_Entity_Model_Entity_Attribute extends Mage_Eav_Model_Entity_Attribute
{
    /** @var string */
    protected $_eventPrefix = 'advanced_entity_attribute';
}
