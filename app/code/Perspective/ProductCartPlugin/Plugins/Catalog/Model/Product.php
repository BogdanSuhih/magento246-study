<?php
namespace Perspective\ProductCartPlugin\Plugins\Catalog\Model;

class Product 
{

    public function afterGetName(\Magento\Catalog\Model\Product $product, $name)
    {
        return "Offer ".$name;
    }

}
