<?php
namespace Perspective\Helloworld\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Perspective\Helloworld\Model\PostFactory;
use Perspective\Helloworld\Model\ResourceModel\Post;

class AddData implements DataPatchInterface, PatchVersionInterface
{
    private $_postFactory;
    private $_postResource;
    private $_moduleDataSetup;

    public function __construct(
        PostFactory $postFactory,
        Post $postResource,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->_postFactory = $postFactory;
        $this->_postResource = $postResource;
        $this->_moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->_moduleDataSetup->startSetup();

        for ($i=1; $i<6; $i++) {
            $postDTO = $this->_postFactory->create();
            $postDTO
            ->setPostName("Post_$i")
            ->setUrlKey("Post_$i")
            ->setPostContent("Post_$i")
            ->setTags("post")
            ->setStatus($i)
            ->setFeaturedImage("Image_$i")
            ->setCreatedAt("2022-01-10")
            ->setUpdatedAt("2022-01-31");
            $this->_postResource->save($postDTO);
        }
        $this->_moduleDataSetup->endSetup();

    }

    public static function getDependencies()

    {
        return [];
    }

    public static function getVersion()

    {
        return '1.0.3';
    }

    public function getAliases()


    {
        return [];
    }
}
