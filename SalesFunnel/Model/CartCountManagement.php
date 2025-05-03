<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Model;

use AGL\SalesFunnel\Api\CartCountManagementInterface;
use AGL\SalesFunnel\Model\ResourceModel\CartCount as CartCountResource;

/**
 * Class CartCountManagement
 * Implementation of cart count API
 */
class CartCountManagement implements CartCountManagementInterface
{
    /**
     * @var CartCountResource
     */
    private $cartCountResource;

    /**
     * @param CartCountResource $cartCountResource
     */
    public function __construct(
        CartCountResource $cartCountResource
    ) {
        $this->cartCountResource = $cartCountResource;
    }

    /**
     * {@inheritdoc}
     */
    public function getCartCount($sku)
    {
        return $this->cartCountResource->getCartCount($sku);
    }
}
