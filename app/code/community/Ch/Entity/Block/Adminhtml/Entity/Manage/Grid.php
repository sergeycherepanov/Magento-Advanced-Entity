<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

/**
 * @method Ch_Entity_Block_Adminhtml_Entity_Manage_Grid setUseAjax(boolean $flag)
 */
class Ch_Entity_Block_Adminhtml_Entity_Manage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Initialize grid
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('entity_grid');
        $this->setDefaultSort('advanced_type_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
    }

    /**
     * @return Ch_Entity_Block_Adminhtml_Items_Grid
     */
    protected function _prepareCollection()
    {
        /** @var $collection Ch_Entity_Model_Resource_Entity_Type_Collection */
        $collection = Mage::getResourceModel('ch_entity/entity_type_collection');
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
        $this->addColumn('advanced_type_id', array(
            'header'    =>  $this->__('ID'),
            'align'     =>  'left',
            'index'     =>  'advanced_type_id',
            'type'  => 'number',
            'width' => '50px',
        ));

        $this->addColumn('entity_type_id', array(
            'header'    =>  $this->__('Type ID'),
            'align'     =>  'left',
            'index'     =>  'entity_type_id',
            'type'  => 'number',
            'width' => '50px',
        ));

        $this->addColumn('entity_type_name', array(
            'header'    =>  $this->__('Name'),
            'align'     =>  'left',
            'index'     =>  'entity_type_name',
        ));

        $this->addColumn('entity_type_code', array(
            'header'    =>  $this->__('Code'),
            'align'     =>  'left',
            'index'     =>  'entity_type_code',
        ));

        $this->addColumn('action', array(
            'header'    =>  $this->__('Action'),
            'width'     =>  '100',
            'type'      =>  'action',
            'getter'    =>  'getId',
            'actions'   =>  array(
                array(
                    'caption'   => $this->__('Manage Items'),
                    'url'       => array('base'=> '*/*/manage'),
                    'field'     => 'type_id',
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
        return $this->getUrl('*/*/manage', array('type_id' => $row->getId()));
    }
}
