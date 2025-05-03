<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Plugin\Catalog\Model;

use Magento\Catalog\Api\Data\ProductExtensionInterface;
use Magento\Catalog\Api\Data\ProductInterface;

/**
 * Class ProductExtensionAttributes
 * Plugin for Product Extension Attributes
 */
class ProductExtensionAttributes
{
    /**
     * After get extension attributes
     *
     * @param ProductInterface $subject
     * @param ProductExtensionInterface|null $result
     * @return ProductExtensionInterface|null
     */
    public function afterGetExtensionAttributes(
        ProductInterface $subject,
        $result
    ) {
        return $result;
    }
} 