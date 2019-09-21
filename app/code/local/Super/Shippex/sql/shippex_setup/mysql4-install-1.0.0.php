<?php

use Super_Shippex_Model_Resource_Point as PointResource;

$installer = $this;

$installer->startSetup();

$connection = $installer->getConnection();
$table = $connection
    ->newTable($installer->getTable('shippex/point'))
    ->addColumn(PointResource::FIELD_ID, Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Id')
    ->addColumn(PointResource::FIELD_NAME, Varien_Db_Ddl_Table::TYPE_TEXT,
        PointResource::getFieldLength(PointResource::FIELD_NAME),
        array('nullable' => false), 'Name')
    ->addColumn(PointResource::FIELD_CODE, Varien_Db_Ddl_Table::TYPE_VARCHAR,
        PointResource::getFieldLength(PointResource::FIELD_CODE),
        array('nullable' => false), 'Code')
    ->addColumn(PointResource::FIELD_STREET, Varien_Db_Ddl_Table::TYPE_VARCHAR,
        PointResource::getFieldLength(PointResource::FIELD_STREET),
        array('nullable' => false), 'Street')
    ->addColumn(PointResource::FIELD_NUMBER, Varien_Db_Ddl_Table::TYPE_VARCHAR,
        PointResource::getFieldLength(PointResource::FIELD_NUMBER),
        array('nullable' => false), 'Street Number')
    ->addColumn(PointResource::FIELD_CITY, Varien_Db_Ddl_Table::TYPE_VARCHAR,
        PointResource::getFieldLength(PointResource::FIELD_CITY),
        array('nullable' => false), 'City')
    ->addColumn(PointResource::FIELD_POSTCODE, Varien_Db_Ddl_Table::TYPE_VARCHAR,
        PointResource::getFieldLength(PointResource::FIELD_POSTCODE),
        array('nullable' => false), 'Postcode');

$installer->getConnection()->createTable($table);

$installer->endSetup();