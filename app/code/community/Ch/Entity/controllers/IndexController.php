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
