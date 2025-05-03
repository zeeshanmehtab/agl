<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Plugin\Catalog\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\ExtensionAttributesFactory;
use AGL\SalesFunnel\Model\ResourceModel\CartCount;

/**
 * Class ProductRepository
 * Plugin for Product Repository
 */
class ProductRepository
{
    /**
     * @var ExtensionAttributesFactory
     */
    private $extensionAttributesFactory;

    /**
     * @var CartCount
     */
    private $cartCountResource;

    /**
     * @param ExtensionAttributesFactory $extensionAttributesFactory
     * @param CartCount $cartCountResource
     */
    public function __construct(
        ExtensionAttributesFactory $extensionAttributesFactory,
        CartCount $cartCountResource
    ) {
        $this->extensionAttributesFactory = $extensionAttributesFactory;
        $this->cartCountResource = $cartCountResource;
    }

    /**
     * Add cart count to product extension attributes
     *
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterGet(
        ProductRepositoryInterface $subject,
        ProductInterface $product
    ) {
        $this->addCartCountExtensionAttribute($product);
        return $product;
    }

    /**
     * Add cart count to product extension attributes in product list
     *
     * @param ProductRepositoryInterface $subject
     * @param \Magento\Framework\Api\SearchResultsInterface $searchResults
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function afterGetList(
        ProductRepositoryInterface $subject,
        \Magento\Framework\Api\SearchResultsInterface $searchResults
    ) {
        $products = $searchResults->getItems();
        
        foreach ($products as $product) {
            $this->addCartCountExtensionAttribute($product);
        }
        
        return $searchResults;
    }

    /**
     * Add cart count extension attribute to product
     *
     * @param ProductInterface $product
     * @return void
     */
    private function addCartCountExtensionAttribute(ProductInterface $product)
    {
        // Check if it's an AGL product
        if ($product->getCustomAttribute('agl_product') && 
            $product->getCustomAttribute('agl_product')->getValue() == 1) {
            
            $cartCount = $this->cartCountResource->getCartCount($product->getSku());
            
            $extensionAttributes = $product->getExtensionAttributes();
            if (!$extensionAttributes) {
                $extensionAttributes = $this->extensionAttributesFactory->create();
            }
            
            $extensionAttributes->setAglCartCount($cartCount);
            $extensionAttributes->setAglCartCountFormatted($cartCount . ' AGL customers love this product!');
            
            $product->setExtensionAttributes($extensionAttributes);
        }
    }
} 