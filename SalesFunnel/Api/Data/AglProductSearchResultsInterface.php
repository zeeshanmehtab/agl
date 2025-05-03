<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface AglProductSearchResultsInterface
 * Search results interface for AGL products
 */
interface AglProductSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get AGL products list.
     *
     * @return \AGL\SalesFunnel\Api\Data\AglProductInterface[]
     */
    public function getItems();

    /**
     * Set AGL products list.
     *
     * @param \AGL\SalesFunnel\Api\Data\AglProductInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
} 