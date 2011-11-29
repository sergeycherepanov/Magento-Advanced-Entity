<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

/**
 * Helper Model
 */
class Ch_Entity_Helper_Data extends Mage_Core_Helper_Abstract
{
    /** @var Ch_Entity_Model_Url */
    protected $_urlModel;

    /**
     * @return Ch_Entity_Model_Url
     */
    public function getUrlModel()
    {
        if (is_null($this->_urlModel)) {
            $this->_urlModel = Mage::getSingleton('ch_entity/url');
        }
        return $this->_urlModel;
    }
}
