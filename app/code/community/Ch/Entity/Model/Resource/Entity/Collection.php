<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Model_Resource_Entity_Collection extends Mage_Eav_Model_Entity_Collection_Abstract
{
    /**
     * Resource model initialization
     */
    public function _construct()
    {
        $this->_init('ch_entity/entity');
    }
}
