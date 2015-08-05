<?php
class Ceicom_Improve_Helper_Catalog_Product extends Mage_Core_Helper_Abstract
{
	
	public function isChildProductOf($childProductId, $parentProduct)
	{
		$childrenIds = $parentProduct->getTypeInstance(true)->getChildrenIds($parentProduct->getId());
		
		return in_array($childProductId, $childrenIds[0]);
	}

}
