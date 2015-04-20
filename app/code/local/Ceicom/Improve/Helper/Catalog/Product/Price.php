<?php
class Ceicom_Improve_Helper_Catalog_Product_Price extends Mage_Core_Helper_Abstract
{

	public function calculateInstallmentValue($total, $interest, $periods)
    {
		// interest / ( 1 - 1 / (1 + i)^n )
		
		if ($interest <= 0) {
			return ($total / $periods);
		}
		
		$coefficient = pow((1 + $interest), $periods);
		$coefficient = 1 / $coefficient;
		$coefficient = 1 - $coefficient;
		$coefficient = $interest / $coefficient;
		
		return ($total * $coefficient);
    }

    public function calculateInstallments($total, $maxInstallments = 12, $minInstallmentValue, $interest, $installmentsWithoutInterest = 1)
    {
    	for ($installment = 1; $installment <= $maxInstallments; $installment++) {
    		$installmentWithoutInterest = $installment <= $installmentsWithoutInterest ? true : false;
    		$installmentValue = $this->calculateInstallmentValue($total, $installmentWithoutInterest ? 0 : $interest, $installment);
    		$installmentValue = round($installmentValue, 2);

    		if ($installmentValue >= $minInstallmentValue) {
    			$installments[$installment] = array(
	    			'withoutInterest' => $installmentWithoutInterest,
	    			'value'           => $installmentValue,
	    			'total'           => $installment * $installmentValue
				);
    		}    		
    	}

    	return $installments;
    }

}