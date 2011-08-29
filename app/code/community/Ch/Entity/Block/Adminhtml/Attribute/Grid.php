<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Block_Adminhtml_Attribute_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('attribute_grid');
        $this->setDefaultSort('attribute_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * @return Ch_Entity_Block_Adminhtml_Items_Grid
     */
    protected function _prepareCollection()
    {
        /** @var $collection Ch_Entity_Model_Resource_Entity_Attribute_Collection */
        $collection = Mage::getResourceModel('ch_entity/entity_attribute_collection');
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
        $this->addColumn('attribute_id', array(
            'header'    =>  $this->__('ID'),
            'align'     =>  'left',
            'index'     =>  'attribute_id',
            'type'  => 'number',
            'width' => '50px',
        ));

        $this->addColumn('entity_type_id', array(
            'header'    =>  $this->__('Entity Type ID'),
            'align'     =>  'left',
            'index'     =>  'entity_type_id',
            'type'  => 'number',
            'width' => '50px',
        ));

        $this->addColumn('attribute_code', array(
            'header'    =>  $this->__('Code'),
            'align'     =>  'left',
            'index'     =>  'attribute_code',
        ));

        $this->addColumn('frontend_label', array(
            'header'    =>  $this->__('Frontend Label'),
            'align'     =>  'left',
            'index'     =>  'frontend_label',
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

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}
