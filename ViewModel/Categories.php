<?php
namespace Perspective\TutorialEntity\ViewModel;

use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

class Categories implements ArgumentInterface
{
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ){
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return Collection
     * @throws LocalizedException
     */
    public function getCategoryList(): Collection
    {
        $categories = $this->collectionFactory->create();
        $categories->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', 1);
        return $categories;
    }
}
