<?php
declare(strict_types=1);

namespace Perspective\T5\ViewModel\Ex2;
use Magento\Payment\Model\PaymentMethodList;
use Magento\Payment\Model\Config;
use Magento\Payment\Helper\Data as PaymentHelper;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class P6 implements ArgumentInterface
{
    /**
    * @var PaymentMethodList
    */
    private $_modelPayment;
    /**
     * @var Config
     */
    private $_paymentConfig;
    /**
     * @var PaymentHelper
     */
    private $_paymentHelper;

    public function __construct (
        PaymentMethodList $modelPayment,
        Config $paymentConfig,
        PaymentHelper $paymentHelper
    )
    {
        $this->_modelPayment = $modelPayment;
        $this->_paymentConfig = $paymentConfig;
        $this->_paymentHelper = $paymentHelper;
    }

    public function getAllPaymentMethodsList()
    {
        $list = $this->_paymentHelper->getPaymentMethodList();
        return $list;
    }

    public function getActivePaymentMethods()
    {
        return $this->_paymentConfig->getActiveMethods();
    }

    public function getAvailablePaymentMethods ()
    {
        $methods = $this->_modelPayment->getList(0);

        return $methods;
    }
}
