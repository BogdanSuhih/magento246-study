<?php
namespace Perspective\Datapatch\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Perspective\Datapatch\Model\ContactdetailsFactory;
use Perspective\Datapatch\Model\ResourceModel\Contactdetails;

class AddData implements DataPatchInterface, PatchVersionInterface
{
    private $_contactDetailsFactory;
    private $_contactDetailsResource;
    private $_moduleDataSetup;

    public function __construct(
        Contactdetails $contactdetailsResource,
        ContactdetailsFactory $contactdetailsFactory,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->_contactDetailsFactory = $contactdetailsFactory;
        $this->_contactDetailsResource = $contactdetailsResource;
        $this->_moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->_moduleDataSetup->startSetup();
        $contactDTO = $this->_contactDetailsFactory->create();
        $contactDTO->setCustomerName('John')
        ->setCustomerEmail('DoeJ@email.com')
        ->setContactNo('9988884444');
        $this->_contactDetailsResource->save($contactDTO);
        $this->_moduleDataSetup->endSetup();
    }

    public static function getDependencies()

    {
        return [];
    }

    public static function getVersion()

    {
        return '1.0.1';
    }

    public function getAliases()


    {
        return [];
    }
}
