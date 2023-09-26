<?php
namespace Perspective\SchemaPatch\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class DeleteColumn implements SchemaPatchInterface
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
        $this->_moduleDataSetup->getConnection()->dropColumn(
            $this->_moduleDataSetup->getTable('intray_table2'),
            'name'
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
