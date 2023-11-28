<?php
namespace Perspective\CreateSimpleProduct\Plugins\Catalog\Model;

class Product
{
   
    public function beforeSetName(\Magento\Catalog\Model\Product $product, $name)
    {
        return ['(' . $name . ')'];
    }
}
