<?php
namespace Perspective\ChangeProductPricePlugin\Plugin;

class ChangeProductPrice
{
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result+1000;
    }
}
