<?php
namespace Perspective\Consultations\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Ddl\Table;


class AddColumn implements SchemaPatchInterface
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
        $this->_moduleDataSetup->getConnection()->addColumn(
            $this->_moduleDataSetup->getTable('perspective_consultations'),
            'price',
            [
                'type' => Table::TYPE_INTEGER,
                'nullable' => true,
                'comment' => 'Price per hour',
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
