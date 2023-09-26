<?php
namespace Perspective\SchemaPatch\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class ChangeColumn implements SchemaPatchInterface
{
    private $_moduleDataSetup;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->_moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->_moduleDataSetup->startSetup();
        $this->_moduleDataSetup->getConnection()->changeColumn(
            $this->_moduleDataSetup->getTable('intray_table2'),
            'body',
            'content',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 10,
                'nullable' => true,
                'comment' => 'Contents',
            ]
        );
        $this->_moduleDataSetup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
