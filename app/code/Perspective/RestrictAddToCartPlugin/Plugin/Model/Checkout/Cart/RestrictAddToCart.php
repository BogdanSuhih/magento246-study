<?php
namespace Perspective\RestrictAddToCartPlugin\Plugin\Model\Checkout\Cart;

use Magento\Framework\Exception\LocalizedException;

class RestrictAddToCart
{
    private $_currencyInterface;
 
    public function __construct(
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrencyInterface
    )
    {
        $this->_currencyInterface = $priceCurrencyInterface;
    }

    public function beforeAddProduct(\Magento\Checkout\Model\Cart $subject, $productInfo, $requestInfo = null)
    {

        try {
            if ($productInfo->getId() == 1) {
                throw new LocalizedException(__('Could not add %1 with id = %2 to Cart', $productInfo->getName(), $productInfo->getId()));
            }

            $price = 50;
            if ($productInfo->getFinalPrice() < $price) {
                $price = $this->_currencyInterface->convert($price);
                throw new LocalizedException(__('Could not add %1 to Cart. Price < %2', $productInfo->getName(), $price));
            }

            $qty = 3;
            if (isset($requestInfo['qty']) ? $requestInfo['qty'] < $qty : true) {
                throw new LocalizedException(__('Could not add %1 to Cart. Quantity < %2', $productInfo->getName(), $qty));
            }
            
            // if ($productInfo->getFinalPrice() < 50) {
            //     throw new LocalizedException(__('Could not add %1 to Cart', $productInfo->getName()));
            // }

        } catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }

        return [$productInfo, $requestInfo];
    }

}
