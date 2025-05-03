<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Model;

use AGL\SalesFunnel\Api\Data\AglProductSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class AglProductSearchResults
 * Search results for AGL products
 */
class AglProductSearchResults extends SearchResults implements AglProductSearchResultsInterface
{
} 