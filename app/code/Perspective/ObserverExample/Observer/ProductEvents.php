<?php
namespace Perspective\ObserverExample\Observer;

class ProductEvents implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct()
    {
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $myEventData = $observer->getData();

        $product = $observer->getProduct();
        $originalName = $product->getName();
        $modifiedName = '('. $originalName . ' - Content added by Perspective)';
        $product->setName($modifiedName);
    }
}