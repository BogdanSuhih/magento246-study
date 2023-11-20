<?php
namespace Perspective\T15Ex1p2\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class AddCustomerAttribute implements DataPatchInterface
{
    private $_moduleDataSetup;
    private $_eavSetupFactory;
    private $_attributeSetFactory;
    private $_eavConfig;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        AttributeSetFactory $attributeSetFactory,
        Config $eavConfig
    ) {
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->_eavSetupFactory = $eavSetupFactory;
        $this->_attributeSetFactory = $attributeSetFactory;
        $this->_eavConfig = $eavConfig;
    }

    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $customerEntity = $this->_eavConfig->getEntityType(\Magento\Customer\Model\Customer::ENTITY);
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        /** @var $attributeSet AttributeSet */
        $attributeSet = $this->_attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $eavSetup = $this->_eavSetupFactory->create(['setup' => $this->_moduleDataSetup]);
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'customer_yesno',
            [
                'type' => 'int',
                'label' => 'Yes/no',
                'input' => 'boolean',
                'visible' => true,
                'source' => '',
                'backend' => '',
                'user_defined' => false,
                'sort_order' => 1,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => true,
                'is_searchable_in_grid' => true,
                'position' => 1,
                'default' => 0,
                'system' => 0,
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => ['adminhtml_customer'],
            ]);

        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'customer_interests',
            [
                'label' => 'Interests',
                'required' => 0,
                'user_defined' => 1,
                'note' => 'Separate Multiple Intrests with comms',
                'system' => 0,
                'position' => 2,
                'used_in_forms' => [
                                    'adminhtml_customer',
                                    'adminhtml_checkout',
                                    'checkout_register',
                                    'customer_account_create',
                                    'customer_account_edit',
                                ],
                'validate_rules', [
                                    'input_validation' => 1,
                                    'min_text_length' => 3,
                                    'max_text_length' => 30,
                            
                                ],
                
            ]
        );
        
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'customer_dropdown',
            [
                'type' => 'int',
                'input' => 'select',
                'label' => 'How did you hear about us?',
                'system' => 0,
                'position' => 3,
                'sort_order' => 20,
                'visible' => true,
                'note' => '',
                'default_value' => '',
                'is_user_defined' => 1,
                'source' => 'Perspective\T15Ex1p2\Model\Attribute\Source\Dropdown',
            ]
        );
        
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