<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use AGL\SalesFunnel\Model\ResourceModel\CartCount;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Class AddToCart
 * Observer for add to cart event
 */
class AddToCart implements ObserverInterface
{
    /**
     * @var CartCount
     */
    private $cartCountResource;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param CartCount $cartCountResource
     * @param ProductRepositoryInterface $productRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        CartCount $cartCountResource,
        ProductRepositoryInterface $productRepository,
        LoggerInterface $logger
    ) {
        $this->cartCountResource = $cartCountResource;
        $this->productRepository = $productRepository;
        $this->logger = $logger;
    }

    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        try {
            $item = $observer->getEvent()->getData('quote_item');
            $product = $item->getProduct();
            
            // Load full product to get custom attribute
            $fullProduct = $this->productRepository->getById($product->getId());
            
            // Check if it's an AGL product
            if ($fullProduct->getCustomAttribute('agl_product') && 
                $fullProduct->getCustomAttribute('agl_product')->getValue() == 1) {
                
                $sku = $product->getSku();
                
                // Increment cart count
                $this->cartCountResource->incrementCartCount($sku);
            }
        } catch (\Exception $e) {
            $this->logger->error('Error in AGL_SalesFunnel AddToCart observer: ' . $e->getMessage());
        }
    }
} 