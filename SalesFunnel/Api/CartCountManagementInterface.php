<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Api;

/**
 * Interface CartCountManagementInterface
 * API for retrieving cart count for a specific product
 */
interface CartCountManagementInterface
{
    /**
     * Get cart count for a specific product
     *
     * @param string $sku Product SKU
     * @return int
     */
    public function getCartCount($sku);
} 