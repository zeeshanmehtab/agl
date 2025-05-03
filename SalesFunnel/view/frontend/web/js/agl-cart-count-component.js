/**
 * @category    AGL
 * @package     AGL_SalesFunnel
 * @author      Zeeshan Mehtab <zeeshan.mehtab1@gmail.com>
 * @copyright   Copyright (c) 2025 AGL (https://www.agl.com.au)
 */

define([
    'jquery',
    'ko',
    'uiComponent',
    'mage/url',
    'mage/translate'
], function ($, ko, Component, url, $t) {
    'use strict';

    return Component.extend({
        defaults: {
            sku: '',
            isAglProduct: true,
            template: 'AGL_SalesFunnel/cart-count-display'
        },
        
        /**
         * @inheritdoc
         */
        initialize: function (config) {
            this._super();
            return this;
        },

        /**
         * @inheritdoc
         */
        initObservable: function () {
            this._super()
                .observe(['cartCount']);
                
            this.formattedCartCount = ko.computed(function() {
                return $t('%1 AGL customers love this product!').replace('%1', this.cartCount());
            }, this);
            
            return this;
        },
        
        /**
         * @inheritdoc
         */
        initConfig: function (config) {
            this._super();
            
            if (this.isAglProduct) {
                this.fetchCartCount();
                this.initEventListeners();
            }
            
            return this;
        },

        /**
         * Fetch cart count from API
         */
        fetchCartCount: function () {
            var self = this;
            var serviceUrl = url.build('rest/V1/agl/product/' + this.sku + '/cart-count');
            
            $.ajax({
                url: serviceUrl,
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function (response) {
                    self.cartCount(response);
                }
            });
        },

        /**
         * Initialize event listeners for add to cart events
         */
        initEventListeners: function () {
            var self = this;
            
            // Listen for successful add to cart events
            $(document).on('ajax:addToCart', function(event, data) {
                if (data && data.sku === self.sku) {
                    // Refresh cart count after a short delay to allow backend processing
                    setTimeout(function() {
                        self.fetchCartCount();
                    }, 500);
                }
            });
            
            // Listen for product-add-to-cart event (for non-AJAX add to cart)
            $(document).on('product-add-to-cart', function() {
                var currentProductSku = $('input[name="product"]').val();
                if (currentProductSku === self.sku) {
                    setTimeout(function() {
                        self.fetchCartCount();
                    }, 500);
                }
            });
        }
    });
}); 