<?php

namespace Perspective\TutorialEntity\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductFactory;

class ProductInfo implements ArgumentInterface
{
    protected $productCollectionFactory;
    protected $productFactory;
    protected $productRepository;

    public function __construct(
        CollectionFactory $productCollectionFactory,
        ProductFactory $productFactory,
        ProductRepositoryInterface $productRepository
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
    }

    public function getProductsInfo($letter, $minPrice, $maxPrice, $limit = 100)
    {
        // Додавання нових продуктів
        $collection = $this->productCollectionFactory->create();
        $collection->addPriceData();
        $collection->addAttributeToFilter('name', ['like' => $letter . '%']);
        $collection->addAttributeToFilter('price', ['gteq' => $minPrice]);
        $collection->addAttributeToFilter('price', ['lteq' => $maxPrice]);
        $collection->setPageSize($limit);
        $collection->addAttributeToSort('price', 'DESC');

        $productsInfo = [];

        foreach ($collection as $product) {
            $productsInfo[] = [
                'name' => $product->getName(),
                'price' => $product->getPrice()
            ];
        }

        return $productsInfo;
    }

    public function createProductInfo($name, $price)
    {
        $product = $this->productFactory->create();
        $product->setSku('SKU_' . uniqid());
        $product->setName($name);
        $product->setPrice($price);
        $product->setAttributeSetId(4);  // Замініть на ID вашого "Default" набору атрибутів
        $product->setTypeId(\Magento\Catalog\Model\Product\Type::TYPE_SIMPLE);
        $product->setVisibility(\Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH);
        $product->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);

        $this->productRepository->save($product);

        return $product;
    }

}
