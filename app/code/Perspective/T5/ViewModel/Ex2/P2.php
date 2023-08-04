<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex2;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Catalog\Helper\Image as HelperImage;

class P2 implements ArgumentInterface
{
    /**
    * @var \Magento\Catalog\Model\ProductFactory
    */
    private $_productFactory;
    /**
    * @var \Magento\Catalog\Model\ResourceModel\Product
    */
    private $_productResource;
    /**
    * @var \Magento\Catalog\Helper\Image
    */
    private $_imageHelper;

    public function __construct (
        ProductFactory $productFactory,
        Product $productResource,
        HelperImage $imageHelper,
    )
    {
        $this->_productFactory = $productFactory;
        $this->_productResource = $productResource;
        $this->_imageHelper = $imageHelper;
    }

    public function getImage($productId, $imageId)
    {
        $product = $this->getProductById($productId);
        $helper = $this->_imageHelper->init($product, $imageId);
        return $helper;
    }

    public function getProductById($productId)
    {
        if (is_null($productId)) {
            return null;
        }
        $productModel = $this->_productFactory->create();
        $this->_productResource->load($productModel, $productId);
        return $productModel;
    }

}
