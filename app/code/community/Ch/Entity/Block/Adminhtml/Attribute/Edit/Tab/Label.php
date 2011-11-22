<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 *
 * Advanced entity attribute add/edit options
 */
class Ch_Entity_Block_Adminhtml_Attribute_Edit_Tab_Label extends
    Mage_Eav_Block_Adminhtml_Attribute_Edit_Options_Abstract
{
    /**
     * Initialize template
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('ch_entity/attribute/options.phtml');
    }
}
