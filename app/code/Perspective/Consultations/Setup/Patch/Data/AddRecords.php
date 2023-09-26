<?php
namespace Perspective\Consultations\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Perspective\Consultations\Model\ConsultationFactory;
use Perspective\Consultations\Model\ResourceModel\Consultation;

class AddRecords implements DataPatchInterface, PatchVersionInterface
{
    private $_consultationFactory;
    private $_consultationResource;
    private $_moduleDataSetup;

    public function __construct(
        Consultation $consultationResource,
        ConsultationFactory $consultationFactory,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->_consultationFactory = $consultationFactory;
        $this->_consultationResource = $consultationResource;
        $this->_moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {

        $this->_moduleDataSetup->startSetup();

        $cons1 = $this->_consultationFactory->create();
        $cons1
        ->setName('Consultation 4')
        ->setHours(0.3)
        ->setCustomerId(4)
        ->setDiscount(0.06)
        ->setDate('2023-09-15 17:00:00')
        ->setPrice(40);
        $this->_consultationResource->save($cons1);

        $cons2 = $this->_consultationFactory->create();
        $cons2
        ->setName('Consultation 4')
        ->setHours(0.4)
        ->setCustomerId(4)
        ->setDiscount(0.07)
        ->setDate('2023-09-15 18:20:00')
        ->setPrice(40);
        $this->_consultationResource->save($cons2);


        $this->_moduleDataSetup->endSetup();
    }


    public static function getDependencies()

    {
        return [
            \Perspective\Consultations\Setup\Patch\Schema\AddColumn::class
        ];
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
