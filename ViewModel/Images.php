<?php
namespace Perspective\TutorialEntity\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\ProductFactory;


class Images implements ArgumentInterface
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    protected $Context;

    protected $productFactory;
    protected $imageHelper;

    public function __construct(
        Image $imageHelper,
        ProductFactory $productFactory,
        ProductRepository $productRepository
    ) {
        $this->imageHelper = $imageHelper;
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
    }

    public function getProductImageUrl($id)
    {
        $data = [];

        $product = $this->getProduct($id);
        if ($product) {
            $image = $this->imageHelper->init($product, 'product_thumbnail_image');
            if (!empty($image)) {
                $data = [
                    'url' => $image->getUrl(),
                    'height' => $image->getHeight(),
                    'width' => $image->getWidth()
                ];
            }
        }

        return $data;
    }


    public function getProduct($id)
    {
        try {
            $product = $this->productFactory->create()->load($id);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return [];
        }

        return $product;
    }

}
