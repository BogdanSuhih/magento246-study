<?php
namespace Perspective\HideAddToCartButtonPlugin\Plugin;

class HideBtn
{
    public function afterIsSaleable(\Magento\Catalog\Model\Product $product, $result)
    {
        if($product->getFinalPrice() < 50) {
            return false; // For hide button
        } else {
            return true; // For display button
        }
    }
}
