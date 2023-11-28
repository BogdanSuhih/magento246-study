<?php
namespace Perspective\T16Ex2IncreaseCurrencyRate\Plugin\Directory\Model;

class Currency
{
    public function afterGetRate(\Magento\Directory\Model\Currency $subject, $result)
    {
        
                $result = $result * 1.1;

        return $result;
    }
}
