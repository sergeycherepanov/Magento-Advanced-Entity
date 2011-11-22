<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

/**
 * @method Ch_Entity_Block_Adminhtml_Entity_Manage_Entity_Grid setUseAjax(boolean $flag)
 */
class Ch_Entity_Block_Adminhtml_Entity_Manage_Entity_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /** @var Ch_Entity_Model_Entity_Type */
    protected $_entityType;

    /**
     * @return Ch_Entity_Model_Entity_Type
     */
    public function getEntityType()
    {
        if (is_null($this->_entityType)) {
            $this->_entityType = Mage::registry('entity_type');
        }
        return $this->_entityType;
    }

    /**
     * Initialize grid
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('entity_grid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * @return Ch_Entity_Block_Adminhtml_Items_Grid
     */
    protected function _prepareCollection()
    {
        /** @var $collection Ch_Entity_Model_Resource_Entity_Collection */
        $collection = $this->getEntityType()->getEntityModel()->getResourceCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header'    =>  $this->__('ID'),
            'align'     =>  'left',
            'index'     =>  'entity_id',
            'type'  => 'number',
            'width' => '50px',
        ));

        $this->addColumn('created_at', array(
            'header'    =>  $this->__('Created At'),
            'type'     =>  'datetime',
            'index'     =>  'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header'    =>  $this->__('Updated At'),
            'type'     =>  'datetime',
            'index'     =>  'updated_at',
        ));

        $this->addColumn('action', array(
            'header'    =>  $this->__('Action'),
            'width'     =>  '100',
            'type'      =>  'action',
            'getter'    =>  'getId',
            'actions'   =>  array(
                array(
                    'caption'   =>  $this->__('Edit'),
                    'url'       =>  array(
                        'base'=> '*/*/edit',
                        'params' => array('type_id' => $this->getEntityType()->getId())
                    ),
                    'field'     =>  'id'
                )
            ),
            'filter'    =>  false,
            'sortable'  =>  false,
            'is_system' =>  true,
        ));
        return parent::_prepareColumns();
    }

    /**
     * @param Ch_Entity_Model_Entity $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            '*/*/edit',
            array(
                 'id' => $row->getId(),
                 'type_id' => $this->getEntityType()->getId()
            )
        );
    }
}
