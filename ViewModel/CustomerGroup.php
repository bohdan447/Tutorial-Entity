<?php

namespace Perspective\TutorialEntity\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory;

class CustomerGroup implements ArgumentInterface
{
    /**
     * Customer Group Collection
     *
     * @var CollectionFactory
     */
    protected $_customerGroupCollectionFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param CollectionFactory $customerGroupCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        CollectionFactory $customerGroupCollectionFactory,
        array $data = []
    )
    {
        $this->_customerGroupCollectionFactory = $customerGroupCollectionFactory;
    }

    /**
     * Get customer groups
     *
     * @return array
     */
    public function getCustomerGroups()
    {
        $customerGroups = $this->_customerGroupCollectionFactory->create()->toOptionArray();
        array_unshift($customerGroups, ['value' => '', 'label' => __('Any')]);
        return $customerGroups;
    }
}
