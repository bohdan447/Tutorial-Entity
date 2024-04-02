<?php
namespace Perspective\TutorialEntity\ViewModel;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class CustomerList implements ArgumentInterface
{

    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $collectionFactory;

    /**
     * Constructor
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory,
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getCustomers()
    {
        return $this->collectionFactory->create()->setOrder('lastname', 'ASC')->addFieldToSelect('*');
    }
}
