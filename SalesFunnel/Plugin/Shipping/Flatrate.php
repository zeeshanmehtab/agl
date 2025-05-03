<?php
/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

namespace AGL\SalesFunnel\Plugin\Shipping;

use Magento\OfflineShipping\Model\Carrier\Flatrate as BaseFlatrate;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Catalog\Api\ProductRepositoryInterface;

/**
 * Class Flatrate
 * Plugin for Flat Rate shipping method
 */
class Flatrate
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * Modify flat rate shipping price for orders with AGL products
     *
     * @param BaseFlatrate $subject
     * @param \Magento\Shipping\Model\Rate\Result $result
     * @param RateRequest $request
     * @return \Magento\Shipping\Model\Rate\Result
     */
    public function afterCollectRates(
        BaseFlatrate $subject,
        $result,
        RateRequest $request
    ) {
        if ($result === false) {
            return $result;
        }

        $hasAglProduct = false;
        $items = $request->getAllItems();

        foreach ($items as $item) {
            try {
                $product = $this->productRepository->getById($item->getProductId());
                if ($product->getCustomAttribute('agl_product') && 
                    $product->getCustomAttribute('agl_product')->getValue() == 1) {
                    $hasAglProduct = true;
                    break;
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        if ($hasAglProduct) {
            foreach ($result->getAllRates() as $rate) {
                if ($rate->getCarrier() === 'flatrate') {
                    // Change rate from $20 to $10 for orders with AGL products
                    $rate->setPrice(10.00);
                }
            }
        }

        return $result;
    }
} 