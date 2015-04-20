# Magento-CeicomImprove

This is a simple module that improve some Magento functions and adds others.

## Helpers

These are the helpers available so far (view the classes for details):

**Mage::helper('ceicom_improve/catalog_product_price')**
- calculateInstallmentValue: calculate an installment
- calculateInstallments: returns an array with installments

**Mage::helper('ceicom_improve/bundle_catalog_product_bundle')**
- getAddToCartUrl: get a url to add a bundle direct to the cart with its default options

## Observers

**Sales**
- adds price to bundled items added at the cart