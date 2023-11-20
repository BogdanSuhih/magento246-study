<?php
namespace Perspective\ClothingMaterial\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddTextAttribute implements DataPatchInterface
{
    private $_moduleDataSetup;
    private $_eavSetupFactory;
    private $_attributeFactory;

    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup,
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        \Magento\Catalog\Model\ResourceModel\Eav\Attribute $attributeFactory
    )
    {
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->_eavSetupFactory = $eavSetupFactory;
        $this->_attributeFactory = $attributeFactory;
    }

    public function apply()
    {
        $eavSetup = $this->_eavSetupFactory->create(['setup' => $this->_moduleDataSetup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY, 
            'clothing_material', 
            [
                'group'         => 'General',
                'type'          => 'varchar',
                'label'         => 'Clothing Material',
                'input'         => 'select',
                'source'        => \Perspective\ClothingMaterial\Model\Attribute\Source\Material::class,
                'frontend'      => \Perspective\ClothingMaterial\Model\Attribute\Frontend\Material::class,
                'backend'       => \Perspective\ClothingMaterial\Model\Attribute\Backend\Material::class,
                'required'      => false,
                'sort_order'    => 50,
                'global'        => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid'           => false,
                'is_visible_in_grid'        => false,
                'is_filterable_in_grid'     => false,
                'visible'                   => true,
                'is_html_allowed_on_front'  => true,
                'visible_on_front'          => true,
                'user_defined'              => false,
            ]
        );

        // $attribute_id = $this->_attributeFactory->getCollection()
        //        ->addFieldToFilter('attribute_code',['eq'=>"clothing_material"])
        //        ->getFirstItem()->getAttributeId();

        // $eavSetup->addAttributeOption(
        //     ['attribute_id'=>$attribute_id,
        //      'values' => [
        //         3 =>'Option 1', 
        //         2 =>'Option 2', 
        //         1 =>'Option 3',
        //         4 =>'Option 4',
        //                  ]
        //     ]
        // );
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
