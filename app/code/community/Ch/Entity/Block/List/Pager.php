<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_List_Pager extends Mage_Page_Block_Html_Pager
{
    /** @var Ch_Entity_Model_Entity_Type */
    protected $_entityTypeModel;

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
        $urlParams['_current']  = true;
        $urlParams['_escape']   = true;
        $urlParams['_use_rewrite']   = true;
        $urlParams['_query']    = $params;
        return $this->getUrl($this->getEntityType()->getEntityTypeCode() . '/list/index', $urlParams);
    }
}
