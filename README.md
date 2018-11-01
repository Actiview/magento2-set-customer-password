# Magento 2 Set Customer Password 

[![Total Downloads](https://poser.pugx.org/actiview/magento2-set-customer-password/downloads)](https://packagist.org/packages/actiview/magento2-set-customer-password)
[![Latest Stable Version](https://poser.pugx.org/actiview/magento2-set-customer-password/v/stable)](https://packagist.org/packages/actiview/magento2-set-customer-password)

Allow a backend user to set the password for a frontend customer account.  

## Requirements
  * Magento Community Edition 2.0.x-2.2.x or Magento Enterprise Edition 2.0.x-2.2.x

## Installation Method 1 - Installing via composer
  * Run command: `composer require actiview/magento2-set-customer-password`

## Installation Method 2 - Installing using archive
  * Download [zip archive](https://github.com/Actiview/magento2-set-customer-password/archive/master.zip)
  * Extract files
  * In your Magento 2 root directory create: `app/code/Actiview/SetCustomerPassword`
  * Copy files and folders from `src` directory in the archive to the created directory
  
## Enable module:
```
php bin/magento module:enable Actiview_SetCustomerPassword
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
```
## Changelog
### 0.1.0 
First release of this module.

## Support & bugs
Please create an issue in GitHub's [issue tracker](https://github.com/actiview/magento2-set-customer-password/issues).
