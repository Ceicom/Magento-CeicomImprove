<?php
class Ceicom_Improve_Model_Sales_Quote_Observer
{

    public function salesQuoteCollectTotalsBefore($observer)
    {
        $quote = $observer->getEvent()->getQuote();
        $bundlesSelectionsPrices = $this->_getBundlesSelectionsPrices($quote);

        if (count($bundlesSelectionsPrices) > 0) {
            foreach ($quote->getAllItems() as $item) {
                if (!$item->getParentItem()) {
                    continue;
                }

                if (array_key_exists($item->getParentItem()->getProductId(), $bundlesSelectionsPrices)) {
                    $item->setPrice($bundlesSelectionsPrices[$item->getParentItem()->getProductId()][$item->getProductId()]);
                }
            }
        }        
    }

    protected function _getBundlesSelectionsPrices($quote)
    {
        foreach ($quote->getAllVisibleItems() as $item) {
            $product = $item->getProduct();

            if ($product->getTypeId() == 'bundle') {
                $optionsIds = $product->getTypeInstance(true)->getOptionsIds($product);
                $selectionsCollection = $product->getTypeInstance(true)->getSelectionsCollection($optionsIds, $product);

                foreach($selectionsCollection as $option) {
                    $selectionsPrices[$product->getId()][$option->product_id] = $option->selection_price_value;
                }
            }
        }

        return $selectionsPrices;
    }

}