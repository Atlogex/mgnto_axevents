<?php
/** @var Mage_Core_Model_Resource_Setup $installer */


$installer = $this;

$installer->startSetup();

// Закомментированный код ниже работоспособен, но стандарт, скорее всего,
// предполгает использование конструктора с поэтапным построением таблицы.

/*
$installer->run("
    CREATE TABLE IF NOT EXISTS `{$installer->getTable('axevents/axevent')}` (
      `event_id` INT UNSIGNED NOT NULL AUTO_INCREMENT , 
      `title` VARCHAR(255) NOT NULL , 
      `description` TEXT NOT NULL , 
      `image` VARCHAR(255) NOT NULL ,
      `event_date` TIMESTAMP NOT NULL ,
      PRIMARY KEY (`event_id`)) ENGINE = InnoDB;
");
*/

$table = $installer->getConnection()
    ->newTable($installer->getTable('axevents/axevent'))
    ->addColumn('event_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Sample ID')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array())
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, 1000, array())
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array())
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_TINYINT, 1, array())

    ->addIndex($installer->getIdxName('axevents/axevent', 'event_id'), 'event_id');

$installer->getConnection()->createTable($table);

$installer->endSetup();