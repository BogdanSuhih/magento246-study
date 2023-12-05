<?php
namespace Perspective\T18Ex2ObserverIncreaseProductPrice\Observer;

class PriceObserver implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct()
    {
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        
        if ($product instanceof \Magento\Catalog\Model\Product) {
            $price = $product->getPrice();
            $increasedPrice = $price * 1.2;

            $product->setPrice($increasedPrice);
        }
        return $this;
    }
}