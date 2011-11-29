<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Model_Url extends Mage_Core_Model_Url
{

    /**
     * @param array $routeParams
     * @return string
     */
    public function getRoutePath($routeParams = array())
    {
        if (!$this->hasData('route_path')) {
            $routePath = $this->getRequest()->getAlias(Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS);
            if (!empty($routeParams['_use_rewrite'])
                && ($routePath !== null)) {
                $this->setData('route_path', $routePath);
                return $routePath;
            }
            
            if (isset($routeParams['_entity_code']) && isset($routeParams['_entity_id'])) {
                $routePath = sprintf('%s/view/%d/', $routeParams['_entity_code'], $routeParams['_entity_id']);
            } else if (isset($routeParams['_entity_code'])) {
                $routePath = sprintf('%s/list/index', $routeParams['_entity_code']);
            } else {
                $routePath = $this->getActionPath();
            }
            $this->setRouteParam('_entity_code', null);
            $this->setRouteParam('_entity_id', null);

            if ($this->getRouteParams()) {
                foreach ($this->getRouteParams() as $key=>$value) {
                    if (is_null($value) || false===$value || ''===$value || !is_scalar($value)) {
                        continue;
                    }
                    $routePath .= $key.'/'.$value.'/';
                }
            }
            if ($routePath != '' && substr($routePath, -1, 1) !== '/') {
                $routePath.= '/';
            }
            $this->setData('route_path', $routePath);
        }
        return $this->_getData('route_path');
    }
}
