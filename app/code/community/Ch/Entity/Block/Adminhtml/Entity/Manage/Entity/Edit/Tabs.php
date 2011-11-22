<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

/**
 * @method setTitle() Setup form header text
 */
class Ch_Entity_Block_Adminhtml_Entity_Manage_Entity_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    /**
     * Initialize base data
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('ch_entity_manage_entity_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('Item Information'));
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        $this->addTab('main_section', array(
            'label'     =>  $this->__('Item information'),
            'title'     =>  $this->__('Item information'),
            'content'   =>  $this->getLayout()->createBlock('ch_entity/adminhtml_entity_manage_entity_edit_tab_main')
                    ->toHtml(),
        ));

        $activeTabId = htmlspecialchars($this->getRequest()->getParam('tab'));
        if ($activeTabId) {
            $this->setActiveTab($activeTabId);
        }

        return parent::_prepareLayout();
    }
}
