<?php
namespace Perspective\BDScript\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $_postFactory;

    public function __construct(\Perspective\BDScript\Model\PostFactory $postFactory)
    {
        $this->_postFactory = $postFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            for ($i=2; $i<6; $i++) {
                $data = [
                    'name'=> "Post " . $i,
                    'post_content' => "TestPost " . $i,
                    'url_key'=> '/magento-2-module-development/magento-2-post ' . $i . '.html',
                    'tags'=> 'magento 2, post ' . $i,
                    'status'=> 1,
                    'test_field'=> 'testPost ' . $i,
                ];
                $post = $this->_postFactory->create();

                $post->addData($data)->save();

            }
        }
    }
}