<?php
namespace Perspective\T18Ex2ObserverIncreaseProductPrice\Observer;

class CollectionPriceObserver implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct()
    {
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $collection = $observer->getEvent()->getCollection();
        foreach ($collection as $product) {
            
            if ($product instanceof \Magento\Catalog\Model\Product) {
                $price = $product->getPrice();
                $increasedPrice = $price * 1.2;
    
                $product->setPrice($increasedPrice);
            }
        }
        return $this;
    }
}