<?php
namespace Perspective\ObserverSampleEvent\Observer;

class DisplayText implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct()
    {
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $displayText = $observer->getData('mp_text');
        echo $displayText->getText() . " - Event </br>";
		$displayText->setText('Execute event successfully.');
    }
}