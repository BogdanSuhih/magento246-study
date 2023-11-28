<?php
namespace Perspective\T16Ex3DivideInventoryPlugin\Plugin;

class ProductSalableQty
{
    public function afterExecute(\Magento\InventorySalesApi\Api\GetProductSalableQtyInterface $subject, $result)
    {
        
        if($result) {
            
            $result = (float) ceil($result / 2);

        }

        return $result;
    }
}
