<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * @return Ch_Entity_Model_Entity_Type
     */
    public function getEntityType()
    {
        return Mage::registry('entity_type_model');
    }

    /**
     * @param null|array $handles
     * @param bool $generateBlocks
     * @param bool $generateXml
     * @return Mage_Core_Controller_Varien_Action
     */
    public function loadLayout($handles = null, $generateBlocks = true, $generateXml = true)
    {
        if (is_null($handles)) {
            $handles = array(
                'default',
                $this->getFullActionName() . '_' . strtolower($this->getEntityType()->getEntityTypeCode())
            );
        }
        return parent::loadLayout($handles, $generateBlocks, $generateXml);
    }


    /**
     * Render entity list page
     *
     * @return void
     */
    public function listAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Render entity details page
     *
     * @return void
     */
    public function viewAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}
