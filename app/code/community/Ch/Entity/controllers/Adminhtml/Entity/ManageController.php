<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Adminhtml_Entity_ManageController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Entity list page
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
     * @param int $typeId
     * @return Ch_Entity_Model_Entity_Type
     */
    protected function _getEntityType($typeId)
    {
        /** @var $entityType Ch_Entity_Model_Entity_Type */
        $entityType = Mage::getModel('ch_entity/entity_type');
        $entityType->load($typeId);
        return $entityType;
    }

    /**
     * Manages entities by type
     *
     * @return void
     */
    public function manageAction()
    {
        $typeId     = $this->getRequest()->getParam('type_id');
        $entityType = $this->_getEntityType($typeId);
        Mage::register('entity_type', $entityType);

        $this->loadLayout();
        $this->initLayoutMessages('adminhtml/session');
        $this->renderLayout();
    }

    /**
     * Add new entity
     *
     * @return void
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Add or edit entity
     *
     * @return void
     */
    public function editAction()
    {
        $typeId      = $this->getRequest()->getParam('type_id');
        $entityId    = $this->getRequest()->getParam('id');
        $entityType  = $this->_getEntityType($typeId);
        $entityModel = $entityType->getEntityModel();
        $entityModel->load($entityId);

        Mage::register('entity_type', $entityType);
        Mage::register('entity_model', $entityModel);

        $this->loadLayout();
        $this->initLayoutMessages('adminhtml/session');
        $this->renderLayout();
    }

    /**
     * Save item
     *
     * @return void
     */
    public function saveAction()
    {
        try {
            $typeId      = $this->getRequest()->getParam('type_id');
            $entityId    = $this->getRequest()->getParam('entity_id');
            $entityType  = $this->_getEntityType($typeId);
            $entityModel = $entityType->getEntityModel();
            if ($entityId) {
                $entityModel->load($entityId);
            }
            $data = $entityModel->filterData($this->getRequest()->getPost());
            $entityModel->addData($data);
            $entityModel->save();

            $this->_getSession()->addSuccess('Entity saved successfully.');
            if ( $this->getRequest()->getParam('back', false) ) {
                    $this->_redirect(
                        '*/*/edit',
                        array(
                            'id' => $entityModel->getId(),
                            'type_id' => $entityType->getId(),
                            '_current'=>true
                        )
                    );
            } else {
                $this->_redirect('*/*/manage', array('type_id' => $entityType->getId()));
            }
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e);
            $this->_redirectReferer();
        } catch (Exception $e) {
            $this->_getSession()->addException($e, $this->_getHelper()->__("Can't save data."));
            $this->_redirectReferer();
        }
    }
}

