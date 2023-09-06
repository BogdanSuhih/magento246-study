<?php
namespace Perspective\T10Db\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $_reviewFactory;
    protected $_reviewGenerator;

    public function __construct(
        \Perspective\T10Db\Model\ReviewFactory $reviewFactory,
        \Perspective\T10Db\Service\ReviewGenerator $reviewGenerator
    )
    {
        $this->_reviewFactory = $reviewFactory;
        $this->_reviewGenerator = $reviewGenerator;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $products = $this->_reviewGenerator->getRandomProducts(50);
            $customers = $this->_reviewGenerator->getRandomCustomers(5);
            $dataArray = $this->_reviewGenerator->generateReview($products, $customers);

            foreach ($dataArray as $data) {

                $review = $this->_reviewFactory->create();

                $review->addData($data)->save();

            }
        }
    }
}