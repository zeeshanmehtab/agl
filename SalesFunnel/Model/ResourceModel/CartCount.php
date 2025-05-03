<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class CartCount
 * Resource model for agl_product_cart_count table
 */
class CartCount extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('agl_product_cart_count', 'sku');
    }

    /**
     * Increment cart count for a product
     *
     * @param string $sku
     * @return int The new cart count
     */
    public function incrementCartCount($sku)
    {
        $connection = $this->getConnection();
        $table = $this->getMainTable();
        
        // Check if record exists
        $select = $connection->select()
            ->from($table)
            ->where('sku = ?', $sku);
        
        $record = $connection->fetchRow($select);
        
        if ($record) {
            // Update existing record
            $connection->update(
                $table,
                ['cart_count' => new \Zend_Db_Expr('cart_count + 1')],
                ['sku = ?' => $sku]
            );
        } else {
            // Insert new record
            $connection->insert(
                $table,
                [
                    'sku' => $sku,
                    'cart_count' => 1
                ]
            );
        }
        
        // Return the new count
        return $this->getCartCount($sku);
    }

    /**
     * Get cart count for a product
     *
     * @param string $sku
     * @return int
     */
    public function getCartCount($sku)
    {
        $connection = $this->getConnection();
        $table = $this->getMainTable();
        
        $select = $connection->select()
            ->from($table, ['cart_count'])
            ->where('sku = ?', $sku);
        
        $result = $connection->fetchOne($select);
        
        return $result ? (int)$result : 0;
    }
}
