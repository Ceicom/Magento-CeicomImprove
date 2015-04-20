<?php
class Ceicom_Improve_Helper_Bundle_Catalog_Product_Bundle extends Mage_Core_Helper_Abstract
{

	public function getAddToCartUrl($product)
	{
		$addUrl = Mage::helper('checkout/cart')->getAddUrl($product);
		$optionsIds = $product->getTypeInstance(true)->getOptionsIds($product);
		$selectionsCollection = $product->getTypeInstance(true)->getSelectionsCollection($optionsIds, $product);
		$bundleParams = '?';

		foreach($selectionsCollection as $option) {
			$bundleParams .= '&bundle_option[' . $option->option_id . ']=' . $option->selection_id;
			$bundleParams .= '&bundle_option_qty[' . $option->option_id . ']=' . $option->selection_qty;
		}

		return $addUrl . $bundleParams;
	}

}