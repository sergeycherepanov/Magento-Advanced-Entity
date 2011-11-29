<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */
class Ch_Entity_Controller_Router_Standard extends Mage_Core_Controller_Varien_Router_Abstract
{
    protected $_listPattern = "/^(\w+)\/list/";
    protected $_viewPattern = "/^(\w+)\/view\/(\d+)/";

    /**
     * @return void
     */
    public function collectRoutes()
    {
        
    }

    /**
     * checking if this admin if yes then we don't use this router
     *
     * @return bool
     */
    protected function _beforeModuleMatch()
    {
        if (Mage::app()->getStore()->isAdmin()) {
            return false;
        }
        return true;
    }

    /**
     * dummy call to pass through checking
     *
     * @return bool
     */
    protected function _afterModuleMatch()
    {
        return true;
    }

    /**
     * @param Zend_Controller_Request_Http $request
     * @return bool
     */
    public function match(Zend_Controller_Request_Http $request)
    {
        /** @var $request Mage_Core_Controller_Request_Http */
        /** @var $front Mage_Core_Controller_Varien_Front  */
        $front = $this->getFront();
        $path = trim($request->getPathInfo(), '/');

        $matches = array();
        if (preg_match($this->_listPattern, $path, $matches)) {
            $entityCode = $matches[1];
            $request->setParam('entity_code', $entityCode);
            $actionName = 'list';
        } else if (preg_match($this->_viewPattern, $path, $matches)) {
            $entityCode = $matches[1];
            $entityId = $matches[2];
            $request->setParam('entity_code', $entityCode);
            $request->setParam('entity_id', $entityId);
            $actionName = 'view';
        } else {
            return false;
        }

        /** @var $entityType Ch_Entity_Model_Entity_Type */
        $entityType = Mage::getModel('ch_entity/entity_type');
        $entityType->load($entityCode, 'entity_type_code');
        if (!$entityType->getId()) {
            return false;
        }
        Mage::register('entity_type_model', $entityType);
        $request->setRoutingInfo(array(
            'requested_route'      => 'ch_entity',
            'requested_controller' => 'index',
            'requested_action'     => $actionName,
        ));
        $request->setModuleName('ch_entity');
        $request->setControllerName('index');
        $request->setActionName($actionName);
        $request->setControllerModule('Ch_Entity');
        $controllerClassName = $this->getControllerClassName('Ch_Entity', 'index');
        // instantiate controller class
        $controllerInstance = Mage::getControllerInstance($controllerClassName, $request, $front->getResponse());
        // dispatch action
        $request->setDispatched(true);
        $controllerInstance->dispatch($actionName);
        return true;

    }

    /**
     * Generating and validating class file name,
     * class and if everything ok do include if needed and return of class name
     * 
     * @param $realModule
     * @param $controller
     * @return bool|string
     */
    public function getControllerClassName($realModule, $controller)
    {
        $controllerFileName = $this->getControllerFileName($realModule, $controller);
        $controllerClassName = $realModule.'_'.uc_words($controller).'Controller';
        // include controller file if needed
        if (!$this->_includeControllerClass($controllerFileName, $controllerClassName)) {
            return false;
        }

        return $controllerClassName;
    }

    /**
     * Include the file containing controller class if this class is not defined yet
     *
     * @param string $controllerFileName
     * @param string $controllerClassName
     * @return bool
     */
    protected function _includeControllerClass($controllerFileName, $controllerClassName)
    {
        if (!class_exists($controllerClassName, false)) {
            if (!file_exists($controllerFileName)) {
                return false;
            }

            include $controllerFileName;

            if (!class_exists($controllerClassName, false)) {
                throw Mage::exception('Mage_Core', Mage::helper('core')->__('Controller file was loaded but class does not exist'));
            }
        }
        return true;
    }

    /**
     * @param string $realModule
     * @param string $controller
     * @return string
     */
    public function getControllerFileName($realModule, $controller)
    {
        $parts = explode('_', $realModule);
        $realModule = implode('_', array_splice($parts, 0, 2));
        $file = Mage::getModuleDir('controllers', $realModule);
        if (count($parts)) {
            $file .= DS . implode(DS, $parts);
        }
        $file .= DS.uc_words($controller, DS).'Controller.php';
        return $file;
    }
}
