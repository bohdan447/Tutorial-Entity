<?php

namespace Perspective\TutorialEntity\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Payment\Helper\Data as PaymentData;

class Payment implements ArgumentInterface
{
    protected $paymentHelper;

    public function __construct(
        PaymentData $paymentHelper
    )
    {
        $this->paymentHelper = $paymentHelper;
    }

    public function getAllPaymentMethods()
    {
        $allPaymentMethodsArray = $this->paymentHelper->getPaymentMethodList();
        return $allPaymentMethodsArray;
    }
}
