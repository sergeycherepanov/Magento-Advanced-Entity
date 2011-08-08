<?php
/**
 * @category    Ch
 * @package     Ch_Branch
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

/**
 * Branch entity model
 *
 */
class Ch_Branch_Model_Branch extends Mage_Core_Model_Abstract
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    function _construct()
    {
        $this->_init('ch_branch/branch');
    }
}
