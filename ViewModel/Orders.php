<?php
namespace Perspective\TutorialEntity\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Template;

class Orders extends Template implements ArgumentInterface
{
    protected $_orderCollectionFactory;
    protected $_orderConfig;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Sales\Model\Order\Config $orderConfig,
        array $data = []
    ) {
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_orderConfig = $orderConfig;
        parent::__construct($context, $data);
    }

    public function getOrderCollection()
    {
        $collection = $this->_orderCollectionFactory->create()
            ->addAttributeToSelect('*');
        return $collection;
    }

    public function getOrderCollectionByCustomerId($customerId)
    {
        $collection = $this->_orderCollectionFactory->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_id', $customerId)
            ->addFieldToFilter('status', ['in' => $this->_orderConfig->getVisibleOnFrontStatuses()])
            ->setOrder('created_at', 'desc');
        return $collection;
    }
}


