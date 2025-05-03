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
     * @var Json
     */
    private $json;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param Json $json
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        Json $json,
        array $data = []
    ) {
        $this->registry = $registry;
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
        //TODO: Replace with dynamic data
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
        //TODO: Replace with dynamic data
        return 10;
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