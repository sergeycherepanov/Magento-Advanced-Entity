<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Adminhtml_Entity_AttributeController extends Mage_Adminhtml_Controller_Action
{
    /**
     * List attributes
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
     * Add new attribute
     *
     * @return void
     */
    public function addAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit attribute
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
     * Delete attribute
     *
     * @return void
     */
    public function deleteAction()
    {
        $this->_redirect('*/*');
    }
}
