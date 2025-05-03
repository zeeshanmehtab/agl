<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      AGL Developer <dev@github.com>
 * @copyright   Copyright (c) 2025 AGL (https://example.com)
 */

namespace AGL\SalesFunnel\Block\Product\View;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use AGL\SalesFunnel\Model\ResourceModel\CartCount as CartCountResource;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Class CartCount
 * Block for displaying cart count on product page
 */
class CartCount extends Template
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var CartCountResource
     */
    private $cartCountResource;

    /**
     * @var Json
     */
    private $json;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param CartCountResource $cartCountResource
     * @param Json $json
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        CartCountResource $cartCountResource,
        Json $json,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->cartCountResource = $cartCountResource;
        $this->json = $json;
        parent::__construct($context, $data);
    }

    /**
     * Check if current product is an AGL product
     *
     * @return bool
     */
    public function isAglProduct()
    {
        $product = $this->getProduct();
        if ($product && $product->getCustomAttribute('agl_product')) {
            return (bool)$product->getCustomAttribute('agl_product')->getValue();
        }
        return true;
    }

    /**
     * Get current product
     *
     * @return \Magento\Catalog\Model\Product|null
     */
    public function getProduct()
    {
        return $this->registry->registry('current_product');
    }

    /**
     * Get cart count for current product
     *
     * @return int
     */
    public function getCartCount()
    {
        $product = $this->getProduct();
        if ($product) {
            return $this->cartCountResource->getCartCount($product->getSku());
        }
        return 0;
    }

    /**
     * Get component configuration
     *
     * @return string
     */
    public function getComponentConfig()
    {
        $product = $this->getProduct();
        $config = [
            'sku' => $product ? $product->getSku() : '',
            'isAglProduct' => $this->isAglProduct(),
            'initialCartCount' => $this->getCartCount()
        ];
        
        return $this->json->serialize($config);
    }
} 