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
class Ch_Entity_Block_Adminhtml_Attribute_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs
{
    /** @var Ch_Entity_Model_Resource_Entity_Attribute */
    protected $_attributeModel;

    /**
     * Initialize base data
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('ch_entity_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('Attribute Information'));

        $this->_attributeModel = Mage::registry('entity_attribute');
    }

    /**
     * @return Ch_Entity_Model_Resource_Entity_Attribute|mixed
     */
    public function getAttributeModel()
    {
        return $this->_attributeModel;
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        /** @var $layout Mage_Core_Model_Layout */
        $layout = $this->getLayout();
        if (!$this->getAttributeModel()->getEntityTypeId()) {
            $this->addTab('main_section', array(
                'label'     =>  $this->__('Attribute information'),
                'title'     =>  $this->__('Attribute information'),
                'content'   =>  $layout->createBlock('ch_entity/adminhtml_attribute_edit_tab_type')->toHtml(),
            ));
        } else {
            $this->addTab('main_section', array(
                'label'     =>  $this->__('Attribute information'),
                'title'     =>  $this->__('Attribute information'),
                'content'   =>  $layout->createBlock('ch_entity/adminhtml_attribute_edit_tab_main')->toHtml(),
            ));
            $this->addTab('labels_section', array(
                'label'     =>  $this->__('Manage Label / Options'),
                'title'     =>  $this->__('Manage Label / Options'),
                'content'   =>  $layout->createBlock('ch_entity/adminhtml_attribute_edit_tab_label')->toHtml(),
            ));
        }
        $activeTabId = htmlspecialchars($this->getRequest()->getParam('tab'));
        if ($activeTabId) {
            $this->setActiveTab($activeTabId);
        }
        return parent::_prepareLayout();
    }
}
