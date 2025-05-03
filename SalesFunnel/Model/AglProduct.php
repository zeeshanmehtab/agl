<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Model;

use AGL\SalesFunnel\Api\Data\AglProductInterface;
use Magento\Framework\DataObject;

/**
 * Class AglProduct
 * Model for AGL product data
 */
class AglProduct extends DataObject implements AglProductInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * {@inheritdoc}
     */
    public function getCartCount()
    {
        return $this->getData(self::CART_COUNT);
    }

    /**
     * {@inheritdoc}
     */
    public function setCartCount($cartCount)
    {
        return $this->setData(self::CART_COUNT, $cartCount);
    }

    /**
     * {@inheritdoc}
     */
    public function getCartCountFormatted()
    {
        return $this->getData(self::CART_COUNT_FORMATTED);
    }

    /**
     * {@inheritdoc}
     */
    public function setCartCountFormatted($cartCountFormatted)
    {
        return $this->setData(self::CART_COUNT_FORMATTED, $cartCountFormatted);
    }
} 