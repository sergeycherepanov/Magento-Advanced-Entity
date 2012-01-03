<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_List_Pager extends Mage_Page_Block_Html_Pager
{
    protected $_availableLimit = array(5 => 5, 10 => 10, 20 => 20, 50 => 50);

    /** @var Ch_Entity_Model_Entity_Type */
    protected $_entityTypeModel;
    /** @var Ch_Entity_Helper_Entity */
    protected $_helper;

    /**
     * @return Ch_Entity_Helper_Entity
     */
    protected function _getHelper()
    {
        if (is_null($this->_helper)) {
            $this->_helper = Mage::helper('ch_entity/entity');
        }
        return $this->_helper;
    }

    /**
     * @return Ch_Entity_Model_Entity_Type
     */
    public function getEntityType()
    {
        if (is_null($this->_entityTypeModel)) {
            $this->_entityTypeModel = Mage::registry('entity_type_model');
        }
        return $this->_entityTypeModel;
    }

    /**
     * @param array $params
     * @return string
     */
    public function getPagerUrl($params=array())
    {
        $urlParams = array();
        $urlParams['_current']     = true;
        $urlParams['_escape']      = true;
        $urlParams['_query']       = $params;
        $urlParams['_entity_code'] = $this->getEntityType()->getEntityTypeCode();
        return $this->_getHelper()->getUrlModel()->getUrl(null, $urlParams);
    }
}
