<?php
namespace Perspective\ProductCartPlugin\Plugins\Checkout\Model;

class CartAroundAddProduct
{
    public function aroundAddProduct(
        \Magento\Checkout\Model\Cart $subject,
        \Closure $proceed,
        $productInfo,
        $requestInfo = null
    ) {
        $requestInfo['qty'] = 10; // setting quantity to 10
        $result = $proceed($productInfo, $requestInfo);// If the $proceed() function is not executed, the standard code as well as plugins with lower priority will not be enabled.
        // change result here
        return $result;
    }
}
