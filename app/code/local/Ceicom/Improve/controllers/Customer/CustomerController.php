<?php
class Ceicom_Improve_Customer_CustomerController extends Mage_Core_Controller_Front_Action
{
    public function checkExistingCustomerByEmailAction()
    {
        $email = $this->getRequest()->getParam('email');
        $customer = Mage::getModel('customer/customer')->setWebsiteId(Mage::app()->getWebsite()->getId());
        $status = array('is_available' => 0);

        if ($email != null) {
            $customer->loadByEmail($email);
            if ($customer->getId()) {
                $status = array('is_available' => 1);
            }
        }
        echo json_encode($status);
    }
}
