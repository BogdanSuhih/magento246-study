<?php
namespace Perspective\T15Ex2p1\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;

class AddSocialAttribute implements DataPatchInterface
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
            'social',
        [
            'type' => 'int',
            'label' => 'Social',
            'input' => 'boolean',
            'visible' => true,
            'source' => '',
            'position' => 1,
            'default' => 0,
            'system' => 0,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => true,
            'used_in_product_listing' => true
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
