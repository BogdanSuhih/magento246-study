<?php
namespace Perspective\ProductCartPlugin\Plugins\Checkout\Model;

class Cart
{
    public function beforeAddProduct(
        \Magento\Checkout\Model\Cart $subject,
        $productInfo,
        $requestInfo = null
    ) {
        $requestInfo['qty'] = 5;
        return [$productInfo, $requestInfo];
    }
}
