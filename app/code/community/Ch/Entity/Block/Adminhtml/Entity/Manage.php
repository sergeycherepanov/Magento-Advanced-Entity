<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Entity_Manage extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     *  Initialize class prefixes and labels
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_entity_manage';
        $this->_blockGroup = 'ch_entity';
        $this->_headerText = $this->__('Manage Entities');
        parent::__construct();
        $this->removeButton('add');
    }
}
