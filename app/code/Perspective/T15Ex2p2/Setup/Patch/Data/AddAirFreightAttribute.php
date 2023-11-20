<?php
namespace Perspective\T15Ex2p2\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;

class AddAirFreightAttribute implements DataPatchInterface
{
    private $_moduleDataSetup;
    private $_eavSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
    ) {
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->_eavSetupFactory = $eavSetupFactory;
    }

    public function apply()
    {

        $eavSetup = $this->_eavSetupFactory->create(['setup' => $this->_moduleDataSetup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'air_freight_only',
        [
            'group'=> 'General',
            'type' => 'varchar',
            'label' => 'Air freight only',
            'input' => 'select',
            'required' => false,
            'visible' => true,
            'user_defined' => false,
            'source' => \Perspective\T15Ex2p2\Model\Source\Options::class,
            'default' => '',
            // 'option' => [ 
            //     'values' => [],
            // ]

        ]);
 
    }

    public function getAliases()
    {
        return [];
    }

    public static function getDependencies()
    {
        return [];
    }

    public static function getVersion()

    {
        return '1.0.1';
    }
}
