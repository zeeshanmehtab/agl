<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Api;

/**
 * Interface AglProductRepositoryInterface
 * Repository interface for AGL products
 */
interface AglProductRepositoryInterface
{
    /**
     * Get list of all AGL products with their cart counts
     *
     * @return \AGL\SalesFunnel\Api\Data\AglProductInterface[]
     */
    public function getList();

    /**
     * Get AGL product by SKU
     *
     * @param string $sku
     * @return \AGL\SalesFunnel\Api\Data\AglProductInterface
     */
    public function getBySku($sku);
    
    /**
     * Increment cart count for a product
     *
     * @param string $sku Product SKU
     * @return int The new cart count
     */
    public function incrementCartCount($sku);
    
    /**
     * Get cart count for a product
     *
     * @param string $sku Product SKU
     * @return int Cart count value
     */
    public function getCartCount($sku);
} 