<?php
namespace Perspective\Consultations\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Perspective\Consultations\Model\ConsultationFactory;

class AddPrice implements DataPatchInterface, PatchVersionInterface
{
    private $_consultationFactory;
    private $_moduleDataSetup;

    public function __construct(
        ConsultationFactory $consultationFactory,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->_consultationFactory = $consultationFactory;
        $this->_moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->_moduleDataSetup->startSetup();

        $consultationCollection = $this->_consultationFactory->create()->getCollection();

        foreach ($consultationCollection as $consultation) {

            $consultation
            ->setPrice(35);

            $consultation->save();
        }

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
