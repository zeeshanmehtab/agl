<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Model;

use Magento\Framework\Model\AbstractModel;
use AGL\SalesFunnel\Model\ResourceModel\CartCount as CartCountResource;

/**
 * Class CartCount
 * Model for cart count data
 */
class CartCount extends AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CartCountResource::class);
    }
    
    /**
     * Get SKU
     *
     * @return string
     */
    public function getSku()
    {
        return $this->getData('sku');
    }
    
    /**
     * Set SKU
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        return $this->setData('sku', $sku);
    }
    
    /**
     * Get cart count
     *
     * @return int
     */
    public function getCartCount()
    {
        return (int)$this->getData('cart_count');
    }
    
    /**
     * Set cart count
     *
     * @param int $cartCount
     * @return $this
     */
    public function setCartCount($cartCount)
    {
        return $this->setData('cart_count', $cartCount);
    }
    
}
