<?php
namespace Perspective\TutorialEntity\ViewModel;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\CatalogInventory\Api\StockStateInterface;
use Magento\CatalogInventory\Api\Data\StockItemInterface;

class Stock implements ArgumentInterface
{
    /**
     * @var StockStateInterface
     */
    protected $stockState;

    /**
     * @var StockItemInterface
     */
    protected $stockItem;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @param StockStateInterface $stockState
     * @param StockItemInterface $stockItem
     * @param ProductRepository $productRepository
     */
    public function __construct(
        StockStateInterface $stockState,
        StockItemInterface $stockItem,
        ProductRepository $productRepository
    ) {
        $this->stockState = $stockState;
        $this->stockItem = $stockItem;
        $this->productRepository = $productRepository;
    }

    /**
     * @param int $productId
     * @param int|null $websiteId
     * @return float
     */
    public function getStockQty($productId, $websiteId = null)
    {
        return $this->stockState->getStockQty($productId, $websiteId);
    }

    /**
     * @param int $productId
     * @return float
     */
    public function getMinQty($productId)
    {
        $this->stockItem->load($productId, 'product_id');
        return $this->stockItem->getMinQty();
    }

    /**
     * @param int $productId
     * @return float
     */
    public function getMinSaleQty($productId)
    {
        $this->stockItem->load($productId, 'product_id');
        return $this->stockItem->getMinSaleQty();
    }

    /**
     * @param int $productId
     * @return float
     */
    public function getMaxSaleQty($productId)
    {
        $this->stockItem->load($productId, 'product_id');
        return $this->stockItem->getMaxSaleQty();
    }

    /**
     * @param int $productId
     * @param int|null $websiteId
     * @return bool
     */
    public function isInStock($productId, $websiteId = null)
    {
        return $this->stockState->getStockQty($productId, $websiteId) > 0;
    }

    /**
     * @param int $productId
     * @return string
     * @throws NoSuchEntityException
     */
    public function getProductNameById($productId)
    {
        $product = $this->productRepository->getById($productId);
        return $product->getName();
    }
}
