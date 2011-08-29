<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Adminhtml_EntityController extends Mage_Adminhtml_Controller_Action
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
     * Add new entity
     *
     * @return void
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit entity
     *
     * @return void
     */
    public function editAction()
    {
        $this->loadLayout();
        $this->initLayoutMessages('adminhtml/session');

        $this->_addContent($this->getLayout()->createBlock('ch_entity/adminhtml_entity_edit'));
        $this->_addLeft($this->getLayout()->createBlock('ch_entity/adminhtml_entity_edit_tabs'));

        $this->renderLayout();
    }

    public function saveAction()
    {
        $entityName = $this->getRequest()->getParam('name');
        $entityCode = $this->getRequest()->getParam('code');

        try {
            /** @var $advancedTypeModel Ch_Entity_Model_Entity_Type */
            $advancedTypeModel = Mage::getModel('ch_entity/entity_type');
            $advancedTypeModel->load($entityCode, 'entity_type_code');
            if ($advancedTypeModel->getId()) {
                Mage::throwException($this->_getHelper()->__('Entity already exists.'));
            }

            /** @var $setupModel Ch_Entity_Model_Resource_Setup */
            $setupModel = Mage::getResourceModel('ch_entity/setup', 'core_write');
            $setupModel->addEntityType($entityCode, $setupModel->getEntityConfiguration());

            /** @var $savedData array */
            $savedData = $setupModel->getEntityType($entityCode);

            print_r($savedData);

            $advancedTypeModel->addData(
                array(
                    'entity_type_id'   => $savedData['entity_type_id'],
                    'entity_type_code' => $savedData['entity_type_code'],
                    'entity_type_name' => $entityName,
                )
            );
            $advancedTypeModel->save();
            $this->_getSession()->addSuccess('Entity saved successfully.');
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e);
        } catch (Exception $e) {
            $this->_getSession()->addException($e, $this->_getHelper()->__("Can't save entity."));
        }

        $this->_redirect('*/*');
    }

    /**
     * Delete entity
     *
     * @return void
     */
    public function deleteAction()
    {
        $this->_redirect('*/*');
    }
}
