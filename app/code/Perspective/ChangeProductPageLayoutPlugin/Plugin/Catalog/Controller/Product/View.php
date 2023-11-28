<?php
namespace Perspective\ChangeProductPageLayoutPlugin\Plugin\Catalog\Controller\Product;

use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class View
{
    /**
     * @var RequestInterface
     */
    private $_request;

    /**
     * @var ProductRepositoryInterface
     */
    private $_productRepository;

    /**
     * @var StoreManagerInterface
     */
    private $_storeManager;

    /**
     * @param RequestInterface           $request
     * @param ProductRepositoryInterface $productRepository
     * @param StoreManagerInterface      $storeManager
     */
    public function __construct(
        RequestInterface $request,
        ProductRepositoryInterface $productRepository,
        StoreManagerInterface $storeManager
    ) {
        $this->_request = $request;
        $this->_productRepository = $productRepository;
        $this->_storeManager = $storeManager;
    }

    public function afterExecute(\Magento\Catalog\Controller\Product\View $subject, $resultPage)
    {
        if ($resultPage instanceof ResultInterface)
        {
            $productId = (int) $this->_request->getParam('id');
            if ($productId)
            {
                try
                {
                    $product = $this->_productRepository->getById($productId, false, $this->_storeManager->getStore()->getId());
                    if ($product->getFinalPrice() <= 50)
                    {
                        $pageConfig = $resultPage->getConfig();
                        $pageConfig->setPageLayout('2columns-right'); //Set your page layout here.
                    }
                }
                catch (NoSuchEntityException $e)
                {
                    // Add you exception message here.
                }
            }
        }
        return $resultPage;
    }
}
