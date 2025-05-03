<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Api\Data;

/**
 * Interface AglProductInterface
 * Interface for AGL product data
 */
interface AglProductInterface
{
    /**
     * Constants for keys of data array
     */
    const SKU = 'sku';
    const CART_COUNT = 'cart_count';
    const CART_COUNT_FORMATTED = 'cart_count_formatted';

    /**
     * Get SKU
     *
     * @return string
     */
    public function getSku();

    /**
     * Set SKU
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);

    /**
     * Get cart count
     *
     * @return int
     */
    public function getCartCount();

    /**
     * Set cart count
     *
     * @param int $cartCount
     * @return $this
     */
    public function setCartCount($cartCount);

    /**
     * Get formatted cart count
     *
     * @return string
     */
    public function getCartCountFormatted();

    /**
     * Set formatted cart count
     *
     * @param string $cartCountFormatted
     * @return $this
     */
    public function setCartCountFormatted($cartCountFormatted);
} 