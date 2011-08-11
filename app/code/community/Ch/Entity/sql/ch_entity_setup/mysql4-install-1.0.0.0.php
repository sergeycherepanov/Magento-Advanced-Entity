<?php
/** @var $this Ch_Entity_Model_Resource_Setup */
$this->startSetup();
/** @var $connection Varien_Db_Adapter_Pdo_Mysql */
$connection      = $this->getConnection();

// Create main table
$mainTableName = $this->getTable('ch_entity/entity');
/** @var $mainTable Varien_Db_Ddl_Table */
$mainTable     = $connection->newTable($mainTableName);

$mainTable->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ));

$mainTable->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => false,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => false,
        ));

$mainTable->addColumn('parent_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => false,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => false,
        ));

$mainTable->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'identity'  => false,
        'unsigned'  => false,
        'nullable'  => false,
        'primary'   => false,
        ));

$mainTable->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'identity'  => false,
        'unsigned'  => false,
        'nullable'  => false,
        'primary'   => false,
        ));
$mainTable->setOption('auto_increment', 1);
$connection->createTable($mainTable);
// Temporary fix for AUTO_INCREMENT property
$connection->changeColumn($mainTableName, 'entity_id', 'entity_id', 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT');

// Create int value table
$tableName = $this->getTable($mainTableName . '_int');
/** @var $table Varien_Db_Ddl_Table */
$table = $connection->newTable($tableName);
$this->createAttributeValueTable($table, Varien_Db_Ddl_Table::TYPE_INTEGER);

// Create varchar value table
$tableName = $this->getTable($mainTableName . '_varchar');
/** @var $table Varien_Db_Ddl_Table */
$table = $connection->newTable($tableName);
$this->createAttributeValueTable($table, Varien_Db_Ddl_Table::TYPE_VARCHAR, 255);

$this->installEntities();
