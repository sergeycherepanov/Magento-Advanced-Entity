<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Adminhtml_Configure_AttributeController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Choose entity form
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
     * Choose entity form
     *
     * @return void
     */
    public function gridAction()
    {
        $this->loadLayout(array('default', 'adminhtml_attribute_grid'));
        $this->renderLayout('root');
    }

    /**
     * Add new attribute
     *
     * @return void
     */
    public function newAction()
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
        $entityTypeId = $this->getRequest()->getParam('entity_type');
        $attributeId  = $this->getRequest()->getParam('id');

        /** @var $attributeModel Ch_Entity_Model_Entity_Attribute */
        $attributeModel = Mage::getModel('ch_entity/entity_attribute');
        $attributeModel->load($attributeId);

        if (!$attributeModel->getEntityTypeId() && $entityTypeId){
            /** @var $entity Mage_Eav_Model_Entity */
            $entity = Mage::getModel('eav/entity');
            $entity->setType($entityTypeId);
            $attributeModel->setEntityType($entity->getEntityType());
            $attributeModel->setEntityTypeId($entity->getTypeId());
        }

        Mage::register('entity_attribute', $attributeModel);

        $this->loadLayout();
        $this->initLayoutMessages('adminhtml/session');
        $this->renderLayout();
    }

    /**
     * @return void
     */
    public function saveAction()
    {
        try {
            $helper       = $this->_getHelper();
            $entityTypeId = $this->getRequest()->getParam('entity_type_id');
            $attributeId  = $this->getRequest()->getParam('attribute_id');
            $data         = $this->getRequest()->getPost();
            /** @var $setupModel Ch_Entity_Model_Resource_Setup */
            $setupModel   = Mage::getResourceModel('ch_entity/setup', 'core_write');

            if (empty($data)) {
                Mage::throwException($this->_getHelper()->__('Wrong request.'));
            }

            /** @var $session Mage_Admin_Model_Session */
            $session = Mage::getSingleton('adminhtml/session');

            /* @var $attributeModel Ch_Entity_Model_Entity_Attribute */
            $attributeModel = $this->_getAttributeModel();

            if ($attributeId) {
                $attributeModel->load($attributeId);
                if (!$attributeModel->getId()) {
                    Mage::throwException($helper->__('This Attribute no longer exists'));
                }
                $attributeModel->addData(
                    array(
                        'frontend_label' => $data['frontend_label'],
                        'is_required'    => $data['is_required'],
                    )
                );
                
                if ($note = $attributeModel->getData('note')) {
                    $advancedFlags = explode(',', $note);
                } else {
                    $advancedFlags = array();
                }
                if (isset($data['in_grid'])) {
                    $flagIndex = array_search('in_grid', $advancedFlags);
                    if ($data['in_grid']) {
                        $advancedFlags[] = 'in_grid';
                    } else if ($flagIndex){
                        unset($advancedFlags[$flagIndex]);
                    }
                    $advancedFlags = array_unique($advancedFlags);
                }
                $attributeModel->setData('note', implode(',', $advancedFlags));
            } else {
                /** @var $entity Mage_Eav_Model_Entity */
                $entity = Mage::getModel('eav/entity');
                $entity->setType($entityTypeId);

                if (!$entity->getTypeId()) {
                    Mage::throwException($helper->__('This Entity no longer exists'));
                }

                // Validate attribute_code
                $attributeCode     = $data['attribute_code'];
                $validatorAttrCode = new Zend_Validate_Regex(array('pattern' => '/^[a-z][a-z_0-9]{1,254}$/'));
                if (!$validatorAttrCode->isValid($attributeCode)) {
                    Mage::throwException($helper->__('Attribute code is invalid. Please use only letters (a-z), numbers (0-9) or underscore(_) in this field, first character should be a letter.'));
                }
                // Validate frontend_input
                /** @var $validatorInputType Ch_Entity_Model_System_Config_Source_Input_Type_Validator */
                $validatorInputType = Mage::getModel('ch_entity/system_config_source_input_type_validator');
                if (!$validatorInputType->isValid($data['frontend_input'])) {
                    foreach ($validatorInputType->getMessages() as $message) {
                        $session->addError($message);
                    }
                    $this->_redirect('*/*/edit', array('attribute_id' => $attributeId, '_current' => true));
                    return;
                }
                $backendType        = $attributeModel->getBackendTypeByInput($data['frontend_input']);
                $backendModel       = $this->_getBackendModelByType($data['frontend_input']);
                $attributeSetId     = $entity->getEntityType()->getDefaultAttributeSetId();
                $attributeGroupId   = $setupModel->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
                $attributeModel->addData(
                    array(
                        'frontend_label' => $data['frontend_label'],
                        'frontend_input' => $data['frontend_input'],
                        'is_required'    => $data['is_required'],
                        'attribute_code' => $attributeCode,
                        'backend_type'   => $backendType,
                        'backend_model'  => $backendModel,
                        'attribute_code' => $attributeCode,
                        'entity_type'    => $entity->getEntityType(),
                        'entity_type_id' => $entity->getTypeId(),
                        'attribute_set_id'   => $attributeSetId,
                        'attribute_group_id' => $attributeGroupId,
                        'is_user_defined'    => 1,
                    )
                );
                if ($note = $attributeModel->getData('note')) {
                    $advancedFlags = explode(',', $note);
                } else {
                    $advancedFlags = array();
                }
                if (isset($data['in_grid'])) {
                    $flagIndex = array_search('in_grid', $advancedFlags);
                    if ($data['in_grid']) {
                        $advancedFlags[] = 'in_grid';
                    } else if ($flagIndex){
                        unset($advancedFlags[$flagIndex]);
                    }
                    $advancedFlags = array_unique($advancedFlags);
                }
                $attributeModel->setData('note', implode(',', $advancedFlags));
            }
            $frontendInput = $attributeModel->getData('frontend_input');
            if ('select' == $frontendInput || 'multiselect' == $frontendInput) {
                if (isset($data['option'])) {
                    $attributeModel->setData('option', $data['option']);
                    if (isset($data['default'])) {
                        $attributeModel->setData('default', $data['default']);
                    }
                } else {
                    
                }
            }
            // Save attribute model
            $attributeModel->save();

            $this->_getSession()->addSuccess($this->_getHelper()->__('Attribute saved successfully.'));
            if ( $this->getRequest()->getParam('back', false) ) {
                $this->_redirect('*/*/edit', array('id' => $attributeModel->getId(), '_current'=>true));
            } else {
                $this->_redirect('*/*');
            }
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
            $this->_redirectReferer();
        } catch (Exception $e) {
            $this->_getSession()->addException($e, $this->_getHelper()->__("Can't save attribute."));
            $this->_redirectReferer();
        }
    }

    /**
     * @return Ch_Entity_Model_Entity_Attribute
     */
    protected function _getAttributeModel()
    {
        return Mage::getModel('ch_entity/entity_attribute');
    }

    /**
     * @param string $frontendType
     * @return null|string
     */
    protected function _getBackendModelByType($frontendType)
    {
        $result = null;
        switch ($frontendType){
            case 'image':
                $result = 'ch_entity/entity_attribute_backend_image';
                break;
        }
        return $result;
    }

    /**
     * Delete entity
     *
     * @return void
     */
    public function deleteAction()
    {
        /** @var $attributeModel Ch_Entity_Model_Entity_Attribute */
        $attributeModel = $this->_getAttributeModel();
        $attributeModel->load($this->getRequest()->getParam('id'));
        $attributeModel->delete();
        $this->_getSession()->addSuccess($this->_getHelper()->__('Attribute deleted successfully.'));
        $this->_redirect('*/*');
    }
}
