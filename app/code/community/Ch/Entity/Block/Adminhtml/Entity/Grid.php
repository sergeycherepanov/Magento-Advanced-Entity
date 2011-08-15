<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Entity_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('entity_grid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
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
        $this->addColumn('entity_id', array(
            'header'    =>  $this->__('ID'),
            'align'     =>  'left',
            'index'     =>  'entity_id',
            'type'  => 'number',
            'width' => '50px',
        ));

        $this->addColumn('type_id', array(
            'header'    =>  $this->__('Type ID'),
            'align'     =>  'left',
            'index'     =>  'type_id',
            'type'  => 'number',
            'width' => '50px',
        ));

        $this->addColumn('type_code', array(
            'header'    =>  $this->__('Type Code'),
            'align'     =>  'left',
            'index'     =>  'type_code',
        ));

        $this->addColumn('action', array(
            'header'    =>  $this->__('Action'),
            'width'     =>  '100',
            'type'      =>  'action',
            'getter'    =>  'getId',
            'actions'   =>  array(
                array(
                    'caption'   =>  $this->__('Edit'),
                    'url'       =>  array('base'=> '*/*/edit'),
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
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
