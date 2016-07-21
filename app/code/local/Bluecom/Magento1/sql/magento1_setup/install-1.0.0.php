<?php
$installer = $this;
// $installer->startSetup();
// $sql=<<<SQLTEXT
// DROP TABLE IF EXISTS {$this->getTable('blog_posts')};
// CREATE TABLE {$this->getTable('blog_posts')} (
// 	`blogpost_id` int(11) NOT NULL auto_increment,
//   `title` text,
//   `post` text,
//   `date` datetime default NULL,
//   `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
//   PRIMARY KEY  (`blogpost_id`)
//  );
// INSERT INTO {$this->getTable('blog_posts')} VALUES (1,'My New Title','This is a blog post','2010-07-01 00:00:00','2010-07-02 23:12:30');
// INSERT INTO {$this->getTable('blog_posts')} VALUES (2,'My New Title 2','This is a blog post 2 ','2010-07-01 00:00:00','2010-07-02 23:12:31');
		
// SQLTEXT;

// $installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 


$table = $installer->getConnection()
	->newTable($installer->getTable('orders'))
	->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity'  => true,
		'unsigned'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'order_id')
	->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'nullable'  => false,
		), 'Customer ID.')
	->addColumn('product_code', Varien_Db_Ddl_Table::TYPE_VARCHAR, 10, array(
		'nullable'  => false,
		), 'product_code.')
	->addColumn('product_value', Varien_Db_Ddl_Table::TYPE_VARCHAR, 55, array(
		'nullable'  => false,
		), 'product_value')
	->addColumn('period', Varien_Db_Ddl_Table::TYPE_INTEGER, 3, array(
		'nullable'  => false,
		), 'period.')
	->addColumn('amount', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50, array(
		'nullable'  => false,
		), 'amount.')
	->addColumn('full_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50, array(
		'nullable'  => false,
		), 'full_name.')
	->addColumn('telephone', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50, array(
		'nullable'  => true,
		), 'telephone.')
	->addColumn('address', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50, array(
		'nullable'  => true,
		), 'address.')
	->addColumn('email', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50, array(
		'nullable'  => true,
		), 'email.')
	->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'nullable'  => true,
		), 'Description')
	->addColumn('status', Varien_Db_Ddl_Table::TYPE_INTEGER, 3, array(
		'nullable'  => false,
		), 'status.')
	->addColumn('created', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'nullable'  => false,
		), 'Created.')
	->addForeignKey(
        $installer->getFkName(
        	'orders',
            'customer_id',
            'customer_entity',
            'entity_id'
        ),
        $installer->getTable('orders'),
        'customer_id',
        $installer->getTable('customer_entity'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey(
        $installer->getFkName(
        	'orders',
            'product_code',
            'catalog_produt_entity',
            'entity_id'
        ),
        $installer->getTable('orders'),
        'product_code',
        $installer->getTable('catalog_produt_entity'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    );
$installer->getConnection()->createTable($table);

$installer->endSetup();
	 