<?php
/** @var $this Ch_Entity_Model_Resource_Setup */
$this->startSetup();
/** @var $connection Varien_Db_Adapter_Pdo_Mysql */
$connection          = $this->getConnection();

// Create tables
$entityTableName     = $this->getTable('ch_entity/entity');
$entityTypeTableName = $this->getTable('ch_entity/entity_type');

/** @var $entityTable Varien_Db_Ddl_Table */
$entityTable         = $connection->newTable($entityTableName);
/** @var $entityTable Varien_Db_Ddl_Table */
$entityTypeTable     = $connection->newTable($entityTypeTableName);

$entityTable->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ));

$entityTable->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => false,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => false,
        ));

$entityTable->addColumn('parent_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => false,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => false,
        ));

$entityTable->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'identity'  => false,
        'unsigned'  => false,
        'nullable'  => false,
        'primary'   => false,
        ));

$entityTable->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'identity'  => false,
        'unsigned'  => false,
        'nullable'  => false,
        'primary'   => false,
        ));
$entityTable->setOption('auto_increment', 1);
$connection->createTable($entityTable);
// Temporary fix for AUTO_INCREMENT property
$connection->changeColumn($entityTableName, 'entity_id', 'entity_id', 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT');

$entityTypeTable->addColumn('advanced_type_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
));

$entityTypeTable->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => false,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => false,
));

$entityTypeTable->addColumn('entity_type_code', Varien_Db_Ddl_Table::TYPE_VARCHAR, 128, array(
        'nullable'  => false,
));

$entityTypeTable->addColumn('entity_type_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 128, array(
        'nullable'  => false,
));

$entityTypeTable->setOption('auto_increment', 1);
$connection->createTable($entityTypeTable);
// Temporary fix for AUTO_INCREMENT property
$connection->changeColumn($entityTypeTableName, 'advanced_type_id', 'advanced_type_id',
                          'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT');


// Create int value table
$tableName = $this->getTable($entityTableName . '_int');
/** @var $table Varien_Db_Ddl_Table */
$table = $connection->newTable($tableName);
$this->createAttributeValueTable($table, Varien_Db_Ddl_Table::TYPE_INTEGER);

// Create varchar value table
$tableName = $this->getTable($entityTableName . '_varchar');
/** @var $table Varien_Db_Ddl_Table */
$table = $connection->newTable($tableName);
$this->createAttributeValueTable($table, Varien_Db_Ddl_Table::TYPE_VARCHAR, 255);

// Create text value table
$tableName = $this->getTable($entityTableName . '_text');
/** @var $table Varien_Db_Ddl_Table */
$table = $connection->newTable($tableName);
$this->createAttributeValueTable($table, Varien_Db_Ddl_Table::TYPE_TEXT);


// Create datetime value table
$tableName = $this->getTable($entityTableName . '_datetime');
/** @var $table Varien_Db_Ddl_Table */
$table = $connection->newTable($tableName);
$this->createAttributeValueTable($table, Varien_Db_Ddl_Table::TYPE_TIMESTAMP);

// Create decimal value table
$tableName = $this->getTable($entityTableName . '_decimal');
/** @var $table Varien_Db_Ddl_Table */
$table = $connection->newTable($tableName);
$this->createAttributeValueTable($table, Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4');

$this->installEntities();
