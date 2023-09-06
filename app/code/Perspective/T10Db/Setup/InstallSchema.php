<?php
namespace Perspective\T10Db\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
        if (!$installer->tableExists('perspective_t10db_review')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('perspective_t10db_review'))
                ->addColumn('review_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Review ID')
                ->addColumn('product_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => false], 'Product Id')
                ->addColumn('text_rev', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', [], 'Text Review')
                ->addColumn('review_date', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT], 'Created At')
                
                ->addColumn('customer_name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [], 'Customer Name')
                ->addColumn('customer_email', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [], 'Customer Email')

                ->setComment('Review table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('perspective_t10db_review'),
                $setup->getIdxName(
                    $installer->getTable('perspective_t10db_review'),
                    ['text_rev'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['text_rev'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();

    }
}
