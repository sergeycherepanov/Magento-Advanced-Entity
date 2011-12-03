<?php
/**
 * @category    Ch
 * @package     Ch_Entity
 * @copyright   Copyright (c) 2011 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @license     http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 */

class Ch_Entity_Model_Resource_Setup extends Mage_Eav_Model_Entity_Setup
{

    protected $_entityConfiguration = array(
        'entity_model'                => 'ch_entity/entity',
        'table'                       => 'ch_entity/entity',
        'entity_attribute_collection' => 'ch_entity/entity_attribute_collection',
        'attributes'                  => array(),
    );

    /**
     * Create table for attribute value
     *
     * @param Varien_Db_Ddl_Table $table
     * @param string $valueType
     * @param int|null $valueSize
     * @return void
     */
    public function createAttributeValueTable($table, $valueType, $valueSize = null)
    {
        $table->addColumn('value_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'identity'  => true,
                'nullable'  => false,
                'primary'   => true,
                ));

        $table->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'unsigned'  => true,
                'nullable'  => false,
                'default'   => '0',
                ));
        $table->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
                'unsigned'  => true,
                'nullable'  => false,
                'default'   => '0',
                ));
        $table->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
                'unsigned'  => true,
                'nullable'  => false,
                'default'   => '0',
                ));
        $table->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'unsigned'  => true,
                'nullable'  => false,
                'default'   => '0',
                ));
        $table->addColumn('value', $valueType, $valueSize, array(
                'nullable'  => false
                ));

        $table->addIndex('ATTRIBUTE_VALUE_IDX',
                         array('attribute_id', 'store_id', 'entity_id'),
                         array('type'=> 'unique')
        );
        $this->getConnection()->createTable($table);

        // Temporary fix for AUTO_INCREMENT property
        $this->getConnection()->changeColumn(
            $table->getName(),
            'value_id',
            'value_id',
            'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT');
    }

    /**
     * Retrieve entities configuration
     *
     * @return array
     */
    public function getDefaultEntities()
    {
        $entities = array(
            'advanced_entity'                       => array(
                'entity_model'                   => 'ch_entity/entity',
                'table'                          => 'ch_entity/entity',
                'attribute_model'                => 'ch_entity/entity_attribute',
                'entity_attribute_collection'    => 'ch_entity/entity_attribute_collection',
                'attributes'                     => array(
                    'name' => array(
                        'type'               => 'varchar',
                        'label'              => 'Entity Name',
                        'input'              => 'select',
                        'source'             => '',
                        'backend'            => '',
                        'sort_order'         => 20,
                        'visible'            => true,
                        'adminhtml_only'     => 1,
                    ),
                ),
            ),
        );
        return $entities;
    }

    /**
     * @return array
     */
    public function getEntityConfiguration()
    {
        return $this->_entityConfiguration;
    }
}

