<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      AGL Developer <dev@github.com>
 * @copyright   Copyright (c) 2025 AGL (https://example.com)
 */

namespace AGL\SalesFunnel\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * Creates the agl_product_cart_count table
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'agl_product_cart_count'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('agl_product_cart_count')
        )->addColumn(
            'sku',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false, 'primary' => true],
            'Product SKU'
        )->addColumn(
            'cart_count',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'default' => 0],
            'Cart Count'
        )->setComment(
            'AGL Product Cart Count Table'
        );

        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
} 