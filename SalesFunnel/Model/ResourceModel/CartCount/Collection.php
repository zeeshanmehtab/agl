<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Model\ResourceModel\CartCount;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use AGL\SalesFunnel\Model\CartCount as CartCountModel;
use AGL\SalesFunnel\Model\ResourceModel\CartCount as CartCountResource;

/**
 * Class Collection
 * Collection for cart count data
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CartCountModel::class, CartCountResource::class);
    }
    
    
    /**
     * Add SKU filter
     *
     * @param string|array $skus
     * @return $this
     */
    public function addSkuFilter($skus)
    {
        $this->addFieldToFilter('sku', ['in' => (array)$skus]);
        return $this;
    }
}
