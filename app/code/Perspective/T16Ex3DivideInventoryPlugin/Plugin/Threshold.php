<?php
namespace Perspective\T16Ex3DivideInventoryPlugin\Plugin;

class Threshold
{

    public function afterGetStockThresholdQty(\Magento\InventoryConfigurationApi\Api\Data\StockItemConfigurationInterface $subject, $result)
    {
        
        if($result) {
            
            $result = (float) ceil($result / 2);

        }

        return $result;
    }


}
