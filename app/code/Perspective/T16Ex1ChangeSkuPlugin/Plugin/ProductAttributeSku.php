<?php
namespace Perspective\T16Ex1ChangeSkuPlugin\Plugin;

class ProductAttributeSku
{
    public function beforeProductAttribute(
        \Magento\Catalog\Helper\Output $subject, $product, $attributeHtml, $attributeName
    )
    {
        
        if($attributeName === 'sku') {
            $attributeHtml = $product->getId() . ' / ' . $attributeHtml;
        }

        return [$product, $attributeHtml, $attributeName];
    }
}
