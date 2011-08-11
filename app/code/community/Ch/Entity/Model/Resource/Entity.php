<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Model_Resource_Entity extends Mage_Eav_Model_Entity_Abstract
{
    public function __construct()
    {
        $this->setType('entity');
        $this->setConnection('core_read', 'core_write');
    }
}
