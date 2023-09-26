<?php
namespace Perspective\Consultations\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Perspective\Consultations\Model\ConsultationFactory;
use Perspective\Consultations\Model\ResourceModel\Consultation;
use Perspective\Consultations\Model\Consultation as ConsultationModel;

class AddData implements DataPatchInterface, PatchVersionInterface
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
        /** @var ConsultationModel $consultationObj */
        $consData = include __DIR__ . '/../../data.php';

        $this->_moduleDataSetup->startSetup();
        foreach ($consData as $consultation) {
            $consultationObj = $this->_consultationFactory->create();

            $consultationObj
            ->setName($consultation['name'])
            ->setHours($consultation['hours'])
            ->setCustomerId($consultation['customer_id'])
            ->setDiscount($consultation['discount'])
            ->setDate($consultation['date']);

            $this->_consultationResource->save($consultationObj);
        }
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
