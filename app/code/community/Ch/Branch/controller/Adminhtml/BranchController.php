<?php
/**
 * @category    Ch
 * @package     Ch_Branch
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Branch_Adminhtml_BranchController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Branch list page
     *
     * @return void
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->initLayoutMessages('adminhtml/session');
        $this->renderLayout();
    }

    /**
     * Add new branch
     *
     * @return void
     */
    public function addAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit branch
     *
     * @return void
     */
    public function editAction()
    {
        $this->loadLayout();
        $this->initLayoutMessages('adminhtml/session');
        $this->renderLayout();
    }

    /**
     * Delete branch
     *
     * @return void
     */
    public function deleteAction()
    {
        $this->_redirect('*/*');
    }
}
