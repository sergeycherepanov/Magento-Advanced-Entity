<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Model_System_Config_Source_Input_Type_Validator
    extends Mage_Eav_Model_Adminhtml_System_Config_Source_Inputtype_Validator
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->addInputType('image');
    }
}