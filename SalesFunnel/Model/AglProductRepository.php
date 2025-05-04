<?php

/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Model;

use AGL\SalesFunnel\Api\AglProductRepositoryInterface;
use AGL\SalesFunnel\Api\Data\AglProductInterface;
use AGL\SalesFunnel\Api\Data\AglProductInterfaceFactory;
use AGL\SalesFunnel\Model\ResourceModel\CartCount\CollectionFactory as CartCountCollectionFactory;
use AGL\SalesFunnel\Model\ResourceModel\CartCount as CartCountResource;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;

/**
 * Class AglProductRepository
 * Repository for AGL products
 */
class AglProductRepository implements AglProductRepositoryInterface
{
    /**
     * @var AglProductInterfaceFactory
     */
    private $aglProductFactory;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var CartCountCollectionFactory
     */
    private $cartCountCollectionFactory;
    
    /**
     * @var CartCountResource
     */
    private $cartCountResource;

    /**
     * @var ProductCollectionFactory
     */
    private $productCollectionFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param AglProductInterfaceFactory $aglProductFactory
     * @param ProductRepositoryInterface $productRepository
     * @param CartCountCollectionFactory $cartCountCollectionFactory
     * @param CartCountResource $cartCountResource
     * @param ProductCollectionFactory $productCollectionFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        AglProductInterfaceFactory $aglProductFactory,
        ProductRepositoryInterface $productRepository,
        CartCountCollectionFactory $cartCountCollectionFactory,
        CartCountResource $cartCountResource,
        ProductCollectionFactory $productCollectionFactory,
        LoggerInterface $logger
    ) {
        $this->aglProductFactory = $aglProductFactory;
        $this->productRepository = $productRepository;
        $this->cartCountCollectionFactory = $cartCountCollectionFactory;
        $this->cartCountResource = $cartCountResource;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function getList()
    {
        $productCollection = $this->productCollectionFactory->create();
        $productCollection->addFieldToFilter('agl_product', true)
            ->setPageSize(10);

        $items = [];

        foreach ($productCollection as $product) {
            $sku = $product->getSku();
            $aglProduct = $this->getBySku($sku);
            $items[] = $aglProduct;
        }

        return $items;
    }

    /**
     * @inheritdoc
     */
    public function getBySku($sku)
    {
        $cartCountCollection = $this->cartCountCollectionFactory->create();
        $cartCountCollection->addFieldToFilter('sku', $sku)
            ->setPageSize(1);

        /** @var AglProductInterface $aglProduct */
        $aglProduct = $this->aglProductFactory->create();
        $aglProduct->setSku($sku);

        // Set cart count if available, otherwise default to 0
        if ($cartCountCollection->getSize()) {
            $cartCountItem = $cartCountCollection->getFirstItem();
            $aglProduct->setCartCount($cartCountItem->getCartCount());
        } else {
            $aglProduct->setCartCount(0);
        }
        
        $aglProduct->setCartCountFormatted($aglProduct->getCartCount() . ' AGL customers love this product!');

        return $aglProduct;
    }
    
    /**
     * {@inheritdoc}
     */
    public function incrementCartCount($sku)
    {
        
        try {
            $newCount = $this->cartCountResource->incrementCartCount($sku);
            return $newCount;
        } catch (\Exception $e) {
            $this->logger->error("Error incrementing cart count for SKU {$sku}: " . $e->getMessage());
            return 0;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCartCount($sku)
    {        
        return $this->cartCountResource->getCartCount($sku);
    }

}