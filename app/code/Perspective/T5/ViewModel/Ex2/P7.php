<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex2;

use Magento\Shipping\Model\Config;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class P7 implements ArgumentInterface
{
    /**
     * @var Config
     */
    private $_shippingConfig;

    public function __construct (
        Config $shippingConfig,
    )
    {
        $this->_shippingConfig = $shippingConfig;
    }

    public function getActiveShippingMethods()
    {
        return $this->_shippingConfig->getActiveCarriers();
    }
}
