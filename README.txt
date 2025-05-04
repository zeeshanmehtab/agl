# AGL_SalesFunnel Magento Extension

## Installation Guide

Follow the steps below to install the AGL_SalesFunnel Magento extension:

### Step 1: Upload the Extension Files
1. Copy the `AGL/SalesFunnel` folder to the `app/code` directory of your Magento installation.

### Step 2: Enable the Module
1. Open a terminal and navigate to the root directory of your Magento installation.
2. Run the following command to enable the module:
    ```
    php bin/magento module:enable AGL_SalesFunnel
    ```

### Step 3: Run Setup Upgrade
1. Execute the following commands to update the database schema and data:
    ```
    php bin/magento setup:upgrade
    ```

### Step 4: Deploy Static Content (if in Production Mode)
1. If your Magento store is in production mode, run the following command to deploy static content:
    ```
    php bin/magento setup:static-content:deploy
    ```

2. Run DI Compilcation:
    ```
    php bin/magento setup:di:compile
    ```

### Step 5: Clear Cache
1. Clear the Magento cache by running:
    ```
    php bin/magento cache:clean
    ```

### Step 6: Verify Installation
1. Log in to the Magento Admin Panel.
2. Navigate to `Stores > Configuration > Advanced > Advanced`.
3. Ensure that `AGL_SalesFunnel` is listed and enabled.

### Step 7: Data & Configurations
1. If your magento store does not have any products then run following command to generate dummy data:
    ```
    bin/magento setup:perf:generate-fixtures /var/www/html/magento/setup/performance-toolkit/profiles/ce/small.xml
    ```

2. Update a few products and set Attribute Set to 'Default' and 'AGL Product' attribute to 'Yes'.
3. Navigate to `Stores > Configuration > Sales > Delivery Methods` and set Flat rate to $20
4. Naviate to a product page that is already set as AGL Product = yes and start testing.

### Step 8: API Endpoints
1. New API Endpoint for all AGL Products /rest/V1/products/search/AGL
2. New API Endpoint for Cart Count per SKU /rest/V1/agl/product/:sku
3. Update for Product Search API: New Extension attributes added to /rest/V1/products API Endpoint

## Uninstallation Guide

To uninstall the module, follow these steps:

1. Disable the module:
    ```
    php bin/magento module:disable AGL_SalesFunnel
    ```
2. Remove the module files from the `app/code/AGL/SalesFunnel` directory.
3. Run `php bin/magento setup:upgrade` to clean up the database.

## Support

For any issues or questions, please contact our support team at zeeshan.mehtab1@gmail.com
